<?php

use yii\db\Schema;
use yii\db\Migration;

class m150108_150936_AddHashIndexToUsersTable extends Migration
{
    private $_table = 'phpbb_users';
    private $_index = 'index_hash';

    public function up()
    {
        $this->createIndex($this->_index, $this->_table, 'yii_confirmation_hash');
    }

    public function down()
    {
        $this->dropIndex($this->_index, $this->_table);
    }
}
