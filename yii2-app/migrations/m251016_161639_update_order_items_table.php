<?php

use yii\db\Migration;

class m251016_161639_update_order_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Add foreign key constraint for items table
        $this->addForeignKey(
            'fk_order_items_Item_id',
            '{{%order_items}}',
            'order_item_Item_id',
            '{{%items}}',
            'item_Id',
            'CASCADE',
            'CASCADE'
        );

        // Add indexes for better performance
        $this->createIndex('idx_order_items_Order_id', '{{%order_items}}', 'order_item_Order_id');
        $this->createIndex('idx_order_items_Item_id', '{{%order_items}}', 'order_item_Item_id');
        $this->createIndex('idx_order_items_Order_Item', '{{%order_items}}', ['order_item_Order_id', 'order_item_Item_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop indexes
        $this->dropIndex('idx_order_items_Order_Item', '{{%order_items}}');
        $this->dropIndex('idx_order_items_Item_id', '{{%order_items}}');
        $this->dropIndex('idx_order_items_Order_id', '{{%order_items}}');
        
        // Drop foreign key
        $this->dropForeignKey('fk_order_items_Item_id', '{{%order_items}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251016_161639_update_order_items_table cannot be reverted.\n";

        return false;
    }
    */
}
