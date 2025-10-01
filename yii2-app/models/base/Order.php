<?php

namespace app\models\base;

class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'order_number', 'total_amount', 'status', 'order_date'], 'required'],
            [['customer_id'], 'integer'],
            [['total_amount'], 'number'],
            [['status'], 'string'],
            [['order_date'], 'date'],
            [['customer_id'], 'exist', 'targetClass' => Customer::class, 'targetAttribute' => 'id'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'order_number' => 'Order Number',
            'total_amount' => 'Total Amount',
            'status' => 'Status',
            'order_date' => 'Order Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
