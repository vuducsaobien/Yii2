<?php

namespace app\models;
use app\models\Base as BaseModel;

class Table1 extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'table_1';
    }
}
