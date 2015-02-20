<?php

use yii\db\Schema;
use yii\db\Migration;

class m150220_145120_add_new_columns_to_item extends Migration
{
    private $_table = 'item';

    public function safeUp()
    {
        $this->addColumn($this->_table, 's_brand',      Schema::TYPE_STRING . ' NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_model',      Schema::TYPE_STRING . ' NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_producer',   Schema::TYPE_STRING . ' NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_watt',       Schema::TYPE_STRING . ' NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_product',    Schema::TYPE_STRING . ' NOT NULL DEFAULT ""');
    }

    public function safeDown()
    {
        $this->dropColumn($this->_table, 's_brand');
        $this->dropColumn($this->_table, 's_model');
        $this->dropColumn($this->_table, 's_producer');
        $this->dropColumn($this->_table, 's_watt');
        $this->dropColumn($this->_table, 's_product');
    }
}
