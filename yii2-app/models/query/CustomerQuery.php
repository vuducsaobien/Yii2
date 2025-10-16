<?php

namespace app\models\query;

use yii\db\ActiveQuery;
use app\common\behaviors\CustomRelationBehavior;

class CustomerQuery extends ActiveQuery
{
    private $_customRelations = [];
    
    public function withCustomRelation($relations)
    {
        $this->_customRelations = (array)$relations;
        
        // Eager load các relations
        $this->with($relations);
        
        return $this;
    }
    
    // Override populate để inject behavior vào models
    public function populate($rows)
    {
        $models = parent::populate($rows);
        
        if (!empty($models) && !empty($this->_customRelations)) {
            // Attach behavior to each model
            foreach ($models as $model) {
                $model->attachBehavior('customRelation', [
                    'class' => CustomRelationBehavior::class,
                    'allowedRelations' => $this->_customRelations
                ]);
                
                // Manually set _customRelations để đảm bảo
                $model->_customRelations = $this->_customRelations;
            }
        }
        
        return $models;
    }
}
