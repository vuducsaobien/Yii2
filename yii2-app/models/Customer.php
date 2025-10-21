<?php

namespace app\models;
use app\models\base\Customer as BaseModel;
use app\models\Order;
use app\models\Item;
use app\models\base\Country;
use app\common\enums\CustomerRelationsEnums;

class Customer extends BaseModel
{    
    /**
     * Override fields to control which relations are included
     */
    public function fields()
    {
        $fields = parent::fields();
        // if ($this->_customRelations !== null && !empty($this->_customRelations)) {
        //     // Thêm custom relations
        //     if (in_array(CustomerRelationsEnums::COUNTRY, $this->_customRelations)) {
                $fields['customer_Country_infor'] = CustomerRelationsEnums::COUNTRY;
            // }
            // if (in_array(CustomerRelationsEnums::ORDERS, $this->_customRelations)) {
                $fields['customer_Orders_infor'] = CustomerRelationsEnums::ORDERS;
            // }
        // }
        $fields['customer_Items_infor'] = 'items';
        return $fields;
    }
    
    public function getCountry()
    {
        return $this->hasOne(Country::class, ['country_Id' => 'customer_Country_id']);
    }

    public function getOrders()
    {
        return $this->hasMany(Order::class, ['order_Customer_id' => 'customer_Id']);
    }

    // Cách 1: Sử dụng via với nested relation
    // Customer → Orders → Items
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::class, ['order_item_Order_id' => 'order_Id'])
            ->via('orders');
    }

    public function getItems()
    {
        return $this->hasMany(Item::class, ['item_Id' => 'order_item_Item_id'])
            ->via('orderItems');
    }
}
