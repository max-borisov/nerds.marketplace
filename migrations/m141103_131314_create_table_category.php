<?php

use yii\db\Schema;
use yii\db\Migration;

class m141103_131314_create_table_category extends Migration
{
    private $_tableName = '_category';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id'            => 'pk',
            'title'         => Schema::TYPE_STRING  . ' NOT NULL',
            'created_at'    => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at'    => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
