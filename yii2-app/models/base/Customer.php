<?php

namespace app\models\base;

class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'country_id'], 'required'],
            [['country_id'], 'integer'],
            [['name', 'email'], 'string', 'max' => 100],
            [['email'], 'email'],
            [['email'], 'unique'],
            [['country_id'], 'exist', 'targetClass' => Country::class, 'targetAttribute' => 'id'],
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
            'email' => 'Email',
            'country_id' => 'Country ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function fields()
    {
        $fields = parent::fields();
        $fields['country_infor'] = 'country';
        $fields['orders'] = 'orders';
        return $fields;
    }
}
