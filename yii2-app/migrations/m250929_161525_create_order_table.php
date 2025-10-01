<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m250929_161525_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer()->notNull()->comment('Foreign key to customer table'),
            'order_number' => $this->string(50)->notNull()->comment('Order number'),
            'total_amount' => $this->decimal(10, 2)->notNull()->comment('Total order amount'),
            'status' => $this->string(20)->notNull()->defaultValue('pending')->comment('Order status'),
            'order_date' => $this->date()->notNull()->comment('Order date'),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        // Add foreign key constraint for hasMany relationship
        $this->addForeignKey(
            'fk_order_customer_id',
            '{{%order}}',
            'customer_id',
            '{{%customer}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // Add indexes for better performance
        $this->createIndex('idx_order_customer_id', '{{%order}}', 'customer_id');
        $this->createIndex('idx_order_number', '{{%order}}', 'order_number', true);
        $this->createIndex('idx_order_status', '{{%order}}', 'status');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_order_customer_id', '{{%order}}');
        $this->dropTable('{{%order}}');
    }
}
