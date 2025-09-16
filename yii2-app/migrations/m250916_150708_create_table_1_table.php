<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%table_1}}`.
 */
class m250916_150708_create_table_1_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%table_1}}', [
            'id' => $this->primaryKey(),
            'table_2_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'status' => $this->integer()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%table_1}}');
    }
}
