<?php

use yii\db\Migration;

class m251016_161648_update_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Add additional indexes for better performance
        $this->createIndex('idx_items_name', '{{%items}}', 'item_Name');
        $this->createIndex('idx_items_price', '{{%items}}', 'item_Price');
        $this->createIndex('idx_items_stock_quantity', '{{%items}}', 'item_Stock_quantity');
        
        // Add composite index for common queries
        $this->createIndex('idx_items_category_active', '{{%items}}', ['item_Category', 'item_Is_active']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop indexes
        $this->dropIndex('idx_items_category_active', '{{%items}}');
        $this->dropIndex('idx_items_stock_quantity', '{{%items}}');
        $this->dropIndex('idx_items_price', '{{%items}}');
        $this->dropIndex('idx_items_name', '{{%items}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251016_161648_update_items_table cannot be reverted.\n";

        return false;
    }
    */
}
