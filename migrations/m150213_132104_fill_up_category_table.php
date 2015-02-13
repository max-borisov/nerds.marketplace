<?php

use yii\db\Schema;
use yii\db\Migration;

class m150213_132104_fill_up_category_table extends Migration
{
    private $_table = 'category';

    public function safeUp()
    {
        $this->insert($this->_table, ['title' => 'Headset',     'id' => 1]);
        $this->insert($this->_table, ['title' => 'Tools',       'id' => 2]);
        $this->insert($this->_table, ['title' => 'Amplifiers',  'id' => 3]);
        $this->insert($this->_table, ['title' => 'Apple',       'id' => 4]);
        $this->insert($this->_table, ['title' => 'HiFi4All',    'id' => 5]);
    }

    public function safeDown()
    {
        $this->delete($this->_table, 'id = 1');
        $this->delete($this->_table, 'id = 2');
        $this->delete($this->_table, 'id = 3');
        $this->delete($this->_table, 'id = 4');
        $this->delete($this->_table, 'id = 5');
    }
}
