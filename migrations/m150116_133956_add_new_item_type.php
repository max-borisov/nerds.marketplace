<?php

use yii\db\Schema;
use yii\db\Migration;

class m150116_133956_add_new_item_type extends Migration
{
    private $_table = '_used_item_type';
    private $_id    = 4;

    public function up()
    {
        $this->insert($this->_table, ['title' => 'Unknown', 'id' => $this->_id]);
    }

    public function down()
    {
        $this->delete($this->_table, 'id = ' . $this->_id);
    }
}
