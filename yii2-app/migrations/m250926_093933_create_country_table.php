<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%country}}`.
 */
class m250926_093933_create_country_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%country}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->comment('Country name'),
            'code' => $this->string(5)->notNull()->comment('Country code (ISO)'),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        // Add index for better performance
        $this->createIndex('idx_country_code', '{{%country}}', 'code', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%country}}');
    }
}
