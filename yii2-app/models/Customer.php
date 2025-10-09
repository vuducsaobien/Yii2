<?php

namespace app\models;
use app\models\base\Customer as BaseModel;
use app\models\base\Order;
use app\models\base\Country;
use app\models\base\OrderItem;
use app\models\base\Item;

class Customer extends BaseModel
{
    /**
     * Gets query for the country that this customer belongs to (belongsTo relationship)
     */
    public function getCountry()
    {
        return $this->hasOne(Country::class, ['country_Id' => 'customer_Country_id']);
    }

    /**
     * Gets query for the orders that this customer has (hasMany relationship)
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['order_Customer_id' => 'customer_Id']);
    }
}
