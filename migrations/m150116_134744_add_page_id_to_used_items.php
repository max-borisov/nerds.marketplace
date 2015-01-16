<?php

use yii\db\Schema;
use yii\db\Migration;

class m150116_134744_add_page_id_to_used_items extends Migration
{
    private $_table = '_used_item';
    private $_column = 's_item_id';

    public function up()
    {
        $this->addColumn($this->_table, $this->_column, 'string NOT NULL DEFAULT ""');
    }

    public function down()
    {
        $this->dropColumn($this->_table, $this->_column);
    }
}
