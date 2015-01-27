<?php

use yii\db\Schema;
use yii\db\Migration;

class m150127_085640_AddPostDateIndexToNewsTable extends Migration
{
    private $_table     = '_news';
    private $_column    = 'post_date';
    private $_index     = 'post_date_index';

    public function up()
    {
        $this->createIndex($this->_index, $this->_table, $this->_column);
    }

    public function down()
    {
        $this->dropIndex($this->_index, $this->_table);
    }
}
