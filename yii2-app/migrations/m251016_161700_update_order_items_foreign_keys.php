<?php

use yii\db\Migration;

class m251016_161700_update_order_items_foreign_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Drop old foreign key constraint
        $this->dropForeignKey('fk_order_items_Order_id', '{{%order_items}}');

        // Add new foreign key constraint with updated column names
        $this->addForeignKey(
            'fk_order_items_Order_id_new',
            '{{%order_items}}',
            'order_item_Order_id',
            '{{%order}}',
            'order_Id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop new foreign key
        $this->dropForeignKey('fk_order_items_Order_id_new', '{{%order_items}}');
        
        // Re-add old foreign key
        $this->addForeignKey(
            'fk_order_items_Order_id',
            '{{%order_items}}',
            'order_item_Order_id',
            '{{%order}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }
}

