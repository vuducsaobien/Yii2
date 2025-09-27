<?php

namespace app\models;
use app\models\base\Customer as BaseModel;

class Customer extends BaseModel
{
    public function getCountry()
    {
        return $this->hasOne(Country::class, ['id' => 'country_id']);
    }
}
