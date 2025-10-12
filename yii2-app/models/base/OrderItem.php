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
            [['order_id', 'item_id', 'quantity', 'price', 'total'], 'required'],
            [['order_id', 'item_id', 'quantity'], 'integer'],
            [['price', 'total'], 'number'],
            [['order_id'], 'exist', 'targetClass' => Order::class, 'targetAttribute' => 'id'],
            [['item_id'], 'exist', 'targetClass' => Item::class, 'targetAttribute' => 'id'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'item_id' => 'Item ID',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'total' => 'Total',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
} 