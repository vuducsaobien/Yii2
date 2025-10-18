<?php

namespace app\models\base;

class OrderItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_item_Order_id', 'order_item_Item_id', 'order_item_Quantity', 'order_item_Price', 'order_item_Total'], 'required'],
            [['order_item_Order_id', 'order_item_Item_id', 'order_item_Quantity'], 'integer'],
            [['order_item_Price', 'order_item_Total'], 'number'],
            [['order_item_Order_id'], 'exist', 'targetClass' => Order::class, 'targetAttribute' => 'id'],
            [['order_item_Item_id'], 'exist', 'targetClass' => Item::class, 'targetAttribute' => 'item_Id'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_item_Id' => 'ID',
            'order_item_Order_id' => 'Order ID',
            'order_item_Item_id' => 'Item ID',
            'order_item_Quantity' => 'Quantity',
            'order_item_Price' => 'Price',
            'order_item_Total' => 'Total',
            'order_item_Created_at' => 'Created At',
            'order_item_Updated_at' => 'Updated At',
        ];
    }
} 