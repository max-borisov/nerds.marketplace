<?php

use yii\db\Schema;
use yii\db\Migration;

class m150127_133922_add_post_date_index_to_reviews_tables extends Migration
{
    private $_table = '_reviews';
    private $_index = '_post_date_index';

    public function up()
    {
        $this->createIndex($this->_index, $this->_table, 'post_date');
    }

    public function down()
    {
        $this->dropIndex($this->_index, $this->_table);
    }
}
