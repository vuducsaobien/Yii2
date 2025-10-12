<?php

namespace app\models;
use app\models\base\Customer as BaseModel;
use app\models\base\Order;
use app\models\base\Country;
use app\models\base\OrderItem;
use app\models\base\Item;

class Customer extends BaseModel
{
    public $relations = ['country', 'orders'];
    
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

    /**
     * Gets query for the order items that belong to this customer's orders (hasMany through via relationship)
     * This uses the orders relationship as a bridge
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::class, ['order_id' => 'id'])->via('orders');
    }

    /**
     * Gets query for the items that belong to this customer's orders (hasMany through via relationship)
     * This uses the orderItems relationship as a bridge
     */
    public function getItems()
    {
        return $this->hasMany(Item::class, ['id' => 'item_id'])->via('orderItems');
    }
}
