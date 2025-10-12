<?php

namespace app\models\base;

class Item extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'price', 'stock_quantity'], 'required'],
            [['price', 'stock_quantity'], 'number'],
            [['is_active'], 'boolean'],
            [['name'], 'string', 'max' => 100],
            [['description'], 'string'],
            [['category'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
            'category' => 'Category',
            'stock_quantity' => 'Stock Quantity',
            'is_active' => 'Is Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

 
}
