<?php

use yii\db\Schema;
use yii\db\Migration;

class m150106_122525_add_email_confirmtion_users_table extends Migration
{
    private $_table = 'phpbb_users';

    public function up()
    {
        $this->addColumn($this->_table, 'yii_confirmation_hash', 'string NOT NULL');
        $this->addColumn($this->_table, 'yii_confirmation_timestamp', 'integer NOT NULL');
    }

    public function down()
    {
        $this->dropColumn($this->_table, 'yii_confirmation_hash');
        $this->dropColumn($this->_table, 'yii_confirmation_timestamp');
    }
}
