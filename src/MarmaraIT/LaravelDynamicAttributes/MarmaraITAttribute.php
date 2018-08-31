<?php

namespace MarmaraIT\LaravelDynamicAttributes;

use Illuminate\Database\Eloquent\Model;

class MarmaraITAttribute extends Model
{
    public $table = 'marmarait_attributes';

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
}
