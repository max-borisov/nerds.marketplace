<?php

use yii\db\Schema;
use yii\db\Migration;

class m150123_094201_create_news_table extends Migration
{
    private $_table = '_news';

    public function up()
    {
        $this->createTable($this->_table, [
            'id'            => 'pk',
            'title'         => Schema::TYPE_STRING  . ' NOT NULL',
            'af'            => Schema::TYPE_STRING  . ' NOT NULL',
            'notice'        => Schema::TYPE_STRING  . ' NOT NULL',
            'post'          => Schema::TYPE_TEXT    . ' NOT NULL',

            'created_at'    => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at'    => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable($this->_table);
    }
}
