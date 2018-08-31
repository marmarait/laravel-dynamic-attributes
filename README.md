# Laravel 5.5 Dynamic Attributes
## Overview
Add Additional Fields to your Models with a key value table

## Install
`composer require marmarait/laravel-dynamic-attributes`

## Usage

* add the Trait "HasDynamicAttributes" to your model
* in the method "getDynamicAttributes" return an array with the dynamic attributes and their field types.
 Available are:
  * string
  * text
  * int
  * double
  * object
  * date
  * time
  * datetime
  
* Use it as you normally would with static attributes.

Example:
If you want your Users Model to have an additional field named "country" with type string:
Add HasDynamicAttributes to your User model
Make the getDynamicAttributes method return `['country'=>'string']`

Set the field by assigning the property to the model:

`$user->country='Austria';`

Retrieving the Property is about the same:

`echo $user->country; // 'Austria'`