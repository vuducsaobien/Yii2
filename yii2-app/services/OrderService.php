<?php

namespace app\services;

class OrderService extends BaseService
{
    public function getListViaTable(): array
    {
        // /*
            // return $this->orderModel::find()->with(['items'])->all();
            return $this->orderModel::find()->with(['items','orderItems'])->all(); // bị lỗi vì không có relation orderItems
            /*
            Data:
                Order table         OrderItem table                                                 Item table
                | order_Id |        |order_item_Id| order_item_Order_id | order_item_Item_id |      | item_Id |
                |----------|        |-------------|---------------------|--------------------|      |---------|
                | 1        |        | 1           | 1                   | 1                  |      | 1       |
                | 2        |        | 2           | 1                   | 2                  |      | 2       |
                | 3        |        | 3           | 2                   | 2                  |      | 3       |
                | 4        |                                                                        | 4       |         
                | 5        |
                | 6        |
                | 7        |

            Query:
                SELECT * FROM `order`
                SELECT * FROM `order_items` WHERE `order_item_Order_id` IN (1, 2, 3, 4, 5, 6, 7)
                SELECT * FROM `items` WHERE `item_Id` IN (1, 2)
        // */
    }

    public function getListVia(): array
    {
        return $this->orderModel::find()->with(['items'])->all();
    }

    public function getListViaOrderItems(): array
    {
        // return $this->orderModel::find()->with(['items', 'orderItems'])->all();
        return $this->orderModel::find()->with(['items','orderItems'])->asArray()->all();
    }
}
