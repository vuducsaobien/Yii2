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
            [['item_Name', 'item_Price', 'item_Stock_quantity'], 'required'],
            [['item_Price', 'item_Stock_quantity'], 'number'],
            [['item_Is_active'], 'boolean'],
            [['item_Name'], 'string', 'max' => 100],
            [['item_Description'], 'string'],
            [['item_Category'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_Id' => 'ID',
            'item_Name' => 'Name',
            'item_Description' => 'Description',
            'item_Price' => 'Price',
            'item_Category' => 'Category',
            'item_Stock_quantity' => 'Stock Quantity',
            'item_Is_active' => 'Is Active',
            'item_Created_at' => 'Created At',
            'item_Updated_at' => 'Updated At',
        ];
    }

 
}
