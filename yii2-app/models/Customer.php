<?php

namespace app\models;
use app\models\base\Customer as BaseModel;
use app\models\base\Order;
use app\models\base\Country;

class Customer extends BaseModel
{
    /**
     * Gets query for the country that this customer belongs to (belongsTo relationship)
     */
    public function getCountry()
    {
        return $this->hasOne(Country::class, ['id' => 'country_id']);
    }

    /**
     * Gets query for the orders that this customer has (hasMany relationship)
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['customer_id' => 'id']);
    }
}
