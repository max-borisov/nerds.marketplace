<?php

use yii\db\Schema;
use yii\db\Migration;

class m150227_150831_add_item_unique_index extends Migration
{
    private $_table = 'item';
    private $_index = 'index_site_id_category_id_s_item_id';

    public function up()
    {
        $this->createIndex($this->_index, $this->_table, 'site_id, category_id, s_item_id', true);
    }

    public function down()
    {
        $this->dropIndex($this->_index, $this->_table);
    }
}
