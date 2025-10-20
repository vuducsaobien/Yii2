<?php

namespace app\models;
use app\models\base\Item as BaseModel;

class Item extends BaseModel
{
    // Use via instead of direct relationship (via table))
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::class, ['order_item_Item_id' => 'item_Id']);
    }

    public function getOrders()
    {
        return $this->hasMany(Order::class, ['order_Id' => 'order_item_Order_id'])->via('orderItems');
    }
}
