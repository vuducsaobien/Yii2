<?php

use yii\db\Migration;

class m251008_164953_update_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('{{%customer}}', 'id', 'customer_Id');
        $this->renameColumn('{{%customer}}', 'name', 'customer_Name');
        $this->renameColumn('{{%customer}}', 'email', 'customer_Email');
        $this->renameColumn('{{%customer}}', 'country_id', 'customer_Country_id');
        $this->renameColumn('{{%customer}}', 'created_at', 'customer_Created_at');
        $this->renameColumn('{{%customer}}', 'updated_at', 'customer_Updated_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('{{%customer}}', 'customer_Id', 'id');
        $this->renameColumn('{{%customer}}', 'customer_Name', 'name');
        $this->renameColumn('{{%customer}}', 'customer_Email', 'email');
        $this->renameColumn('{{%customer}}', 'customer_Country_id', 'country_id');
        $this->renameColumn('{{%customer}}', 'customer_Created_at', 'created_at');
        $this->renameColumn('{{%customer}}', 'customer_Updated_at', 'updated_at');
    }
}
