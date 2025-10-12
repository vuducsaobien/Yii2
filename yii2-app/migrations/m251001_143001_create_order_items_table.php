<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_items}}`.
 */
class m251001_143001_create_order_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_items}}', [
            'order_item_Id' => $this->primaryKey(),
            'order_item_Order_id' => $this->integer()->notNull()->comment('Foreign key to order table'),
            'order_item_Item_id' => $this->integer()->notNull()->comment('Foreign key to item table'),
            'order_item_Quantity' => $this->integer()->notNull()->comment('Quantity'),
            'order_item_Price' => $this->decimal(10, 2)->notNull()->comment('Price'),
            'order_item_Total' => $this->decimal(10, 2)->notNull()->comment('Total'),
            'order_item_Created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'order_item_Updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        // Add foreign key constraint for hasMany relationship
        $this->addForeignKey(
            'fk_order_items_Order_id',
            '{{%order_items}}',
            'order_item_Order_id',
            '{{%order}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // Note: Foreign key for items table will be added in a separate migration
        // after the items table is created
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_order_items_Order_id', '{{%order_items}}');
        $this->dropTable('{{%order_items}}');
    }
}
