<?php

namespace app\models;
use app\models\base\Item as BaseModel;

class Item extends BaseModel
{
    /**
     * Gets query for the order items that reference this item (hasMany relationship)
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::class, ['item_id' => 'id']);
    }

    /**
     * Gets query for the orders that contain this item (hasMany through via relationship)
     * This uses the orderItems relationship as a bridge
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['id' => 'order_id'])->via('orderItems');
    }
}
