<?php

use yii\db\Schema;
use yii\db\Migration;

class m150213_131512_add_category_table extends Migration
{
    private $_table = 'category';

    public function up()
    {
        $this->createTable($this->_table, [
            'id'            => 'pk',
            'title'         => Schema::TYPE_STRING  . ' NOT NULL',
            'created_at'    => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at'    => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable($this->_table);
    }
}
