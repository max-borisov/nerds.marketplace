<?php

use yii\db\Schema;
use yii\db\Migration;

class m150116_133536_add_new_category extends Migration
{
    private $_table = '_category';
    private $_id    = 5;

    public function up()
    {
        $this->insert($this->_table, ['title' => 'HiFi4All', 'id' => $this->_id]);
    }

    public function down()
    {
        $this->delete($this->_table, 'id = ' . $this->_id);
    }
}
