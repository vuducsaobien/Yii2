<?php

use yii\db\Migration;

class m251008_165018_update_country_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('{{%country}}', 'id', 'country_Id');
        $this->renameColumn('{{%country}}', 'name', 'country_Name');
        $this->renameColumn('{{%country}}', 'code', 'country_Code');
        $this->renameColumn('{{%country}}', 'created_at', 'country_Created_at');
        $this->renameColumn('{{%country}}', 'updated_at', 'country_Updated_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('{{%country}}', 'country_Id', 'id');
        $this->renameColumn('{{%country}}', 'country_Name', 'name');
        $this->renameColumn('{{%country}}', 'country_Code', 'code');
        $this->renameColumn('{{%country}}', 'country_Created_at', 'created_at');
        $this->renameColumn('{{%country}}', 'country_Updated_at', 'updated_at');
    }
}
