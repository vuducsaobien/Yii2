<?php

namespace app\models;
use app\models\base\OrderItem as BaseModel;

class OrderItem extends BaseModel
{
    /**
     * Gets query for the order that owns this order item (belongsTo relationship)
     */
    public function getOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }

    /**
     * Gets query for the item that this order item references (belongsTo relationship)
     */
    public function getItem()
    {
        return $this->hasOne(Item::class, ['id' => 'item_id']);
    }
}
