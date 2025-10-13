<?php

use yii\db\Migration;

class m251012_051742_update_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        try {
            // 1. First drop the old foreign key constraint
            $this->dropForeignKey('fk_customer_country_id', '{{%customer}}');

            // 2. Drop old indexes (now safe since foreign key is dropped)
            $this->dropIndex('idx_customer_email', '{{%customer}}');
            $this->dropIndex('idx_customer_country_id', '{{%customer}}');

            // 3. Create new index
            $this->createIndex('idx_customer_Country_id', '{{%customer}}', 'customer_Country_id');

            // 4. Add new foreign key constraint
            $this->addForeignKey(
                'fk_customer_Country_id',
                '{{%customer}}',
                'customer_Country_id',
                '{{%country}}',
                'country_Id',
                'CASCADE',
                'CASCADE'
            );

        } catch (\Exception $e) {
            // If anything fails, rollback
            $this->safeDown();
            throw $e;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {   
        // Reverse the order of the following operations
    
        // 1. Drop new Index
        $this->dropIndex('idx_customer_Country_id', '{{%customer}}');
        
        // 2. Re-create old Indexes
        $this->createIndex('idx_customer_country_id', '{{%customer}}', 'country_id');
        $this->createIndex('idx_customer_email', '{{%customer}}', 'email');
        
        // 3. Drop new foreign key
        $this->dropForeignKey('fk_customer_Country_id', '{{%customer}}');
        
        // 4. Re-add old foreign key
        $this->addForeignKey(
            'fk_customer_country_id',
            '{{%customer}}',
            'country_id',
            '{{%country}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }
}
