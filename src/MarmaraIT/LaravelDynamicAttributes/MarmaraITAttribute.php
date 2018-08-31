<?php

namespace MarmaraIT\LaravelDynamicAttributes;

use Illuminate\Database\Eloquent\Model;

class MarmaraITAttribute extends Model
{
    public $table = 'marmarait_attributes';

    protected $primaryKey = ['subject_type', 'subject_id', 'varname'];
    public $incrementing = false;

    protected $casts=[
        'string_value'=>'string',
        'text_value'=>'string',
        'int_value'=>'integer',
        'double_value'=>'double',
        'object_value'=>'object',
        'date_value'=>'date',
        'time_value'=>'string',
        'datetime_value'=>'datetime',
    ];

    /**
     * Set the keys for a save update query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     * @source https://stackoverflow.com/a/37076437/8302471
     */
    protected function setKeysForSaveQuery(\Illuminate\Database\Eloquent\Builder $query)
    {
        $keys = $this->getKeyName();
        if(!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }

        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    /**
     * Get the primary key value for a save query.
     *
     * @param mixed $keyName
     * @return mixed
     * @source https://stackoverflow.com/a/37076437/8302471
     */
    protected function getKeyForSaveQuery($keyName = null)
    {
        if(is_null($keyName)){
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }
}
