<?php

use yii\db\Schema;
use yii\db\Migration;

class m150306_065200_add_index_to_category_table extends Migration
{
    private $_table = 'category';

    public function up()
    {
        $this->createIndex('index_parent_id', $this->_table, 'parent_id');
    }

    public function down()
    {
        $this->dropIndex('index_parent_id', $this->_table);
    }
}
