<?php

namespace app\models\query;

use Yii;
use yii\db\ActiveQuery;
use app\common\behaviors\CustomRelationBehavior;

// CustomerQuery.php
class CustomerQuery extends ActiveQuery
{
    private $_customRelations = [];
    
    public function withCustomRelation($relations)
    {
        // die('abc-2 - Customer query - withCustomRelation');

        $this->_customRelations = (array)$relations;
        
        // Eager load các relations
        $this->with($relations);
        
        return $this;
    }
    
    // Override populate để inject behavior vào models
    public function populate($rows)
    {
        // die('abc-3 - Customer query - populate');


        $models = parent::populate($rows);

        // echo '<pre style="color:red";>$models === '; print_r($models);echo '</pre>';
        // die();
        
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
