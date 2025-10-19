<?php

namespace app\models;
use app\models\base\Order as BaseModel;

class Order extends BaseModel
{
    public function fields()
    {
        $fields = parent::fields();
        $fields['order_Items_infor'] = 'items';
        $fields['order_Order_items_infor'] = 'orderItems';
        return $fields;
    }

    /*
        public function getItems()
        {
            return $this->hasMany(Item::class, ['item_Id' => 'order_item_Item_id'])
                ->viaTable('order_items', ['order_item_Order_id' => 'order_Id']);
        }
        /*
            Cách 1: Via Table Junction relation - Đi thẳng luôn, không qua trung gian OrderItem
            Via Table Junction relation: Order → Item
    // */

    // /*
        public function getOrderItems()
        {
            return $this->hasMany(OrderItem::class, ['order_item_Order_id' => 'order_Id']);
        }

        public function getItems()
        {
            return $this->hasMany(Item::class, ['item_Id' => 'order_item_Item_id'])->via('orderItems');
        }
        /* Cách 2: Via - relation : Order → OrderItem → Item
            Cách này chi tiết hơn, vì sẽ lấy được cả OrderItem và Items của 1 Oder
    // */
}
