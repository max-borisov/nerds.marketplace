<?php

use yii\db\Schema;
use yii\db\Migration;

class m141121_115523_update_table_phpbb_users extends Migration
{
    private $_table     = 'phpbb_users';
    private $_column    = 'yii_password';

    public function up()
    {
        $this->addColumn($this->_table, $this->_column, Schema::TYPE_STRING . ' NOT NULL');
    }

    public function down()
    {
        $this->dropColumn($this->_table, $this->_column);
    }
}
