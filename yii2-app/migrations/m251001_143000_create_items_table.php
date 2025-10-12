<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%items}}`.
 */
class m251001_143000_create_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%items}}', [
            'item_Id' => $this->primaryKey(),
            'item_Name' => $this->string(100)->notNull()->comment('Item name'),
            'item_Description' => $this->text()->comment('Item description'),
            'item_Price' => $this->decimal(10, 2)->notNull()->comment('Item price'),
            'item_Category' => $this->string(50)->comment('Item category'),
            'item_Stock_quantity' => $this->integer()->notNull()->defaultValue(0)->comment('Stock quantity'),
            'item_Is_active' => $this->boolean()->notNull()->defaultValue(true)->comment('Is item active'),
            'item_Created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'item_Updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        // Add indexes for better performance
        $this->createIndex('idx_items_category', '{{%items}}', 'item_Category');
        $this->createIndex('idx_items_is_active', '{{%items}}', 'item_Is_active');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%items}}');
    }
} 