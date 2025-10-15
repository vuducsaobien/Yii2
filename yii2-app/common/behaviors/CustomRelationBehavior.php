<?php

namespace app\common\behaviors;

use yii\base\Behavior;
use yii\db\ActiveRecord;

/**
 * class CustomRelationBehavior
 */
class CustomRelationBehavior extends Behavior
{
    public $allowedRelations = [];
    
    public function events()
    {
        // die('abc-4 - Custom relation behavior - events');

        return [
            ActiveRecord::EVENT_AFTER_FIND => 'afterFind'
        ];
    }

}