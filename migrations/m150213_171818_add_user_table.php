<?php

use yii\db\Schema;
use yii\db\Migration;

class m150213_171818_add_user_table extends Migration
{
    private $_table = 'user';

    public function up()
    {
        $this->createTable($this->_table, [
            'id'                        => 'pk',
            'name'                      => Schema::TYPE_STRING  . ' NOT NULL',
            'email'                     => Schema::TYPE_STRING  . ' NOT NULL',
            'password'                  => Schema::TYPE_STRING  . ' NOT NULL',
            'confirmation_hash'         => Schema::TYPE_STRING  . ' NOT NULL DEFAULT ""',
            'confirmation_timestamp'    => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',

            'created_at'    => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at'    => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

        $this->createIndex('index_confirmation_hash', $this->_table, 'confirmation_hash');
    }

    public function down()
    {
        $this->dropIndex('index_confirmation_hash', $this->_table);
        $this->dropTable($this->_table);
    }
}
