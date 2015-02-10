<?php

use yii\db\Schema;
use yii\db\Migration;

class m150210_083223_add_unique_index_to_reviews_table extends Migration
{
    private $_table = '_reviews';
    private $_index = 'index_site_id_review_id';

    public function up()
    {
        $this->createIndex($this->_index, $this->_table, 'site_id, review_id', true);
    }

    public function down()
    {
        $this->dropIndex($this->_index, $this->_table);
    }
}
