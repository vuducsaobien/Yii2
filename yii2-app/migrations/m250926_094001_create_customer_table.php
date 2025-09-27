<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%customer}}`.
 */
class m250926_094001_create_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%customer}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->comment('Customer name'),
            'email' => $this->string(100)->notNull()->comment('Customer email'),
            'country_id' => $this->integer()->notNull()->comment('Foreign key to country table'),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        // Add foreign key constraint for hasOne relationship
        $this->addForeignKey(
            'fk_customer_country_id',
            '{{%customer}}',
            'country_id',
            '{{%country}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // Add indexes for better performance
        $this->createIndex('idx_customer_email', '{{%customer}}', 'email', true);
        $this->createIndex('idx_customer_country_id', '{{%customer}}', 'country_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_customer_country_id', '{{%customer}}');
        $this->dropTable('{{%customer}}');
    }
}
