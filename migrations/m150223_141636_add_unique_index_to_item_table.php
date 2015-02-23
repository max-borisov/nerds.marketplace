<?php

use yii\db\Schema;
use yii\db\Migration;

class m150223_141636_add_unique_index_to_item_table extends Migration
{
    private $_table = 'item';
    private $_index = 'index_site_id_s_item_id';

    public function up()
    {
        $this->createIndex($this->_index, $this->_table, 'site_id, s_item_id', true);
    }

    public function down()
    {
        $this->dropIndex($this->_index, $this->_table);
    }
}
