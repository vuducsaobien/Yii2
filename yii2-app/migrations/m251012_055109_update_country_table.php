<?php

use yii\db\Migration;

class m251012_055109_update_country_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // $this->createIndex('idx_country_code', '{{%country}}', 'code', true);
        $this->dropIndex('idx_country_code', '{{%country}}');
        $this->createIndex('idx_country_Code', '{{%country}}', 'country_Code', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_country_Code', '{{%country}}');
        $this->createIndex('idx_country_code', '{{%country}}', 'code', true);
    }
}
