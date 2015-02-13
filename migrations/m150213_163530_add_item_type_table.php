<?php

use yii\db\Schema;
use yii\db\Migration;

class m150213_163530_add_item_type_table extends Migration
{
    private $_table = 'item_type';

    public function safeUp()
    {
        $this->createTable($this->_table, [
            'id'            => 'pk',
            'title'         => Schema::TYPE_STRING  . ' NOT NULL',
            'created_at'    => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at'    => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

        $this->insert($this->_table, ['id' => 1, 'title' => 'Sell']);
        $this->insert($this->_table, ['id' => 2, 'title' => 'Buy']);
        $this->insert($this->_table, ['id' => 3, 'title' => 'Exchange']);
        $this->insert($this->_table, ['id' => 4, 'title' => 'Unknown']);
    }

    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}
