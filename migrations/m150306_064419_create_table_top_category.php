<?php

use yii\db\Schema;
use yii\db\Migration;

class m150306_064419_create_table_top_category extends Migration
{
    private $_table = 'top_category';

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
