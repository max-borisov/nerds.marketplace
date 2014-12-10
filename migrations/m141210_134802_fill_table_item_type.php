<?php

use yii\db\Schema;
use yii\db\Migration;

class m141210_134802_fill_table_item_type extends Migration
{
    private $_tableName = '_used_item_type';

    public function safeUp()
    {
        $time = time();
        $this->insert($this->_tableName, [
            'title'         => 'Sale',
            'created_at'    => $time,
            'updated_at'    => $time,
        ]);
        $this->insert($this->_tableName, [
            'title'         => 'Wanna buy',
            'created_at'    => $time,
            'updated_at'    => $time,
        ]);
    }

    public function safeDown()
    {
        $this->delete($this->_tableName, 'title = :title', [':title' => 'Sale']);
        $this->delete($this->_tableName, 'title = :title', [':title' => 'Wanna buy']);
    }
}
