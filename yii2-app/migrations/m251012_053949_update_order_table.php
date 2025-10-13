<?php

use yii\db\Migration;

class m251012_053949_update_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk_order_customer_id', '{{%order}}');

        $this->addForeignKey(
            'fk_order_Customer_id',
            '{{%order}}',
            'order_Customer_id',
            '{{%customer}}',
            'customer_Id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // 1. Drop new foreign key
        $this->dropForeignKey('fk_order_Customer_id', '{{%order}}');
        
        // 2. Re-add old foreign key
        $this->addForeignKey(
            'fk_order_customer_id',
            '{{%order}}',
            'customer_id',
            '{{%customer}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }
}
