<?php

use yii\db\Migration;

class m251008_165017_update_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('{{%order}}', 'id', 'order_Id');
        $this->renameColumn('{{%order}}', 'customer_id', 'order_Customer_id');
        $this->renameColumn('{{%order}}', 'order_number', 'order_Order_number');
        $this->renameColumn('{{%order}}', 'total_amount', 'order_Total_amount');
        $this->renameColumn('{{%order}}', 'status', 'order_Status');
        $this->renameColumn('{{%order}}', 'order_date', 'order_Order_date');
        $this->renameColumn('{{%order}}', 'created_at', 'order_Created_at');
        $this->renameColumn('{{%order}}', 'updated_at', 'order_Updated_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('{{%order}}', 'order_Id', 'id');
        $this->renameColumn('{{%order}}', 'order_Customer_id', 'customer_id');
        $this->renameColumn('{{%order}}', 'order_Order_number', 'order_number');
        $this->renameColumn('{{%order}}', 'order_Total_amount', 'total_amount');
        $this->renameColumn('{{%order}}', 'order_Status', 'status');
        $this->renameColumn('{{%order}}', 'order_Order_date', 'order_date');
        $this->renameColumn('{{%order}}', 'order_Created_at', 'created_at');
        $this->renameColumn('{{%order}}', 'order_Updated_at', 'updated_at');
    }
}
