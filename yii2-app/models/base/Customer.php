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

    public function fields()
    {
        $fields = parent::fields();
        $fields['country_infor'] = 'country';
        return $fields;
    }
}
