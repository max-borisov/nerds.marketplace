<?php

use yii\db\Schema;
use yii\db\Migration;

class m150127_154303_create_table_reviews_types extends Migration
{
    private $_table = '_reviews_types';

    public function up()
    {
        $this->createTable($this->_table, [
            'id'            => 'pk',
            'title'         => \yii\db\oci\Schema::TYPE_STRING . ' NOT NULL',

            'created_at'    => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at'    => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable($this->_table);
    }
}
