<?php

use yii\db\Schema;
use yii\db\Migration;

class m141103_132144_update_table_used_item extends Migration
{
    private $_tableName = 'used_items';

    public function up()
    {
        $this->addColumn($this->_tableName, 'created_at', Schema::TYPE_INTEGER . ' NOT NULL');
        $this->addColumn($this->_tableName, 'updated_at', Schema::TYPE_INTEGER . ' NOT NULL');
    }

    public function down()
    {
        $this->dropColumn($this->_tableName, 'created_at');
        $this->dropColumn($this->_tableName, 'updated_at');
    }
}
