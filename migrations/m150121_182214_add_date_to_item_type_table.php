<?php

use yii\db\Schema;
use yii\db\Migration;

class m150121_182214_add_date_to_item_type_table extends Migration
{
    private $_table = '_used_item_type';

    public function safeUp()
    {
        $this->insert($this->_table, ['id' => 1, 'title' => 'Sell']);
        $this->insert($this->_table, ['id' => 2, 'title' => 'Buy']);
        $this->insert($this->_table, ['id' => 3, 'title' => 'Exchange']);
        $this->insert($this->_table, ['id' => 4, 'title' => 'Unknown']);
    }

    public function safeDown()
    {
        $this->delete($this->_table, 'id = 1');
        $this->delete($this->_table, 'id = 2');
        $this->delete($this->_table, 'id = 3');
        $this->delete($this->_table, 'id = 4');
    }
}
