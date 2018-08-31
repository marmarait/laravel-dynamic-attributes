<?php

namespace MarmaraIT\LaravelDynamicAttributes;


use Illuminate\Database\Eloquent\Model;

trait HasDynamicAttributes{

    /**
     * Retruns the Dynamit Attributes as a Key - Value array
     * Example: ['field1'=>'string', 'field2'=>'int']
     * @return array
     */
    abstract function getDynamicAttributes();

    /**
     * Relationship with the Attributes
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function attributes(){
        return $this->morphMany(MarmaraITAttribute::class, 'subject');
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return $this|mixed
     */
    public function setAttribute($key, $value){
        // If its not a Dynamic Attribute, continue as usual
        if(!in_array($key, array_keys($this->getDynamicAttributes()))){
            return parent::setAttribute($key, $value);
        }
        $attribute = $this->attributes()->where('varname', $key)->first();
        if(!$attribute){
            $attribute=new MarmaraITAttribute();
            $attribute->vartype=$this->getDynamicAttributes()[$key];
            $attribute->varname=$key;
            $attribute->subject_type=get_class($this);
            $attribute->subject_id=$this->id;
        }

        //switch($this->getDynamicAttributes()[$key]){
        //}

        $attribute->{$this->getDynamicAttributes()[$key].'_value'}=$value;
        $attribute->save();

        return $this;
    }


    /**
     * Get an attribute from the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function getAttribute($key){
        // If its not a Dynamic Attribute, continue as usual
        if(!in_array($key, array_keys($this->getDynamicAttributes()))){
            return parent::getAttribute($key);
        }

        $attribute=$this->attributes()->where('varname', $key)->first();
        if(!$attribute){
            return null;
        }
        return $attribute->{$this->getDynamicAttributes()[$key].'_value'};
    }


    /**
     * Delete the model and all its dynamic attributes from the database.
     *
     * @return bool|null
     *
     * @throws \Exception
     */
    public function delete(){
        $this->attributes()->delete();
        return parent::delete();
    }

}