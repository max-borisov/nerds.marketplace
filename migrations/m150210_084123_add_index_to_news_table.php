<?php

use yii\db\Schema;
use yii\db\Migration;

class m150210_084123_add_index_to_news_table extends Migration
{
    private $_table = '_news';
    private $_index = 'index_site_id';

    public function up()
    {
        $this->createIndex($this->_index, $this->_table, 'site_id');
    }

    public function down()
    {
        $this->dropIndex($this->_index, $this->_table);
    }
}
