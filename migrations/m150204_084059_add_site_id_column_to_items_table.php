<?php

use yii\db\Schema;
use yii\db\Migration;

class m150204_084059_add_site_id_column_to_items_table extends Migration
{
    private $_table = '_used_item';

    public function safeUp()
    {
        $this->addColumn($this->_table, 'site_id', 'integer NOT NULL AFTER s_id');
        $this->createIndex('site_id_index', $this->_table, 'site_id');
        $this->dropColumn($this->_table, 's_id');
    }

    public function safeDown()
    {
        $this->addColumn($this->_table, 's_id', 'integer NOT NULL AFTER site_id');
        $this->dropColumn($this->_table, 'site_id');
    }
}
