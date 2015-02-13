<?php

use yii\db\Schema;
use yii\db\Migration;

class m150213_155131_add_site_table extends Migration
{
    private $_table = 'site';

    public function safeUp()
    {
        $this->createTable($this->_table, [
            'id'    => 'pk',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'created_at'    => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at'    => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

        $this->insert($this->_table, ['id' => 1, 'title' => 'HiFi4All']);
        $this->insert($this->_table, ['id' => 2, 'title' => 'Recordere']);
    }

    public function safeDown()
    {
        $this->delete($this->_table, 'id = 1');
        $this->delete($this->_table, 'id = 2');

        $this->dropTable($this->_table);
    }
}
