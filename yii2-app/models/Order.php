<?php

namespace app\models;
use app\models\base\Order as BaseModel;

class Order extends BaseModel
{
    /**
     * Gets query for the order items that belong to this order (hasMany relationship)
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::class, ['order_id' => 'id']);
    }

    /**
     * Gets query for the items that belong to this order (hasMany through via relationship)
     * This uses the orderItems relationship as a bridge
     */
    public function getItems()
    {
        return $this->hasMany(Item::class, ['id' => 'item_id'])->via('orderItems');
    }
}
