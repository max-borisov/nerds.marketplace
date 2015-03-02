<?php

use yii\db\Schema;
use yii\db\Migration;

class m150302_103146_rename_column_in_items_table extends Migration
{
    private $_table = 'item';

    public function up()
    {
        $this->renameColumn($this->_table, 'type_id', 'ad_type_id');
    }

    public function down()
    {
        $this->renameColumn($this->_table, 'ad_type_id', 'type_id');
    }
}
