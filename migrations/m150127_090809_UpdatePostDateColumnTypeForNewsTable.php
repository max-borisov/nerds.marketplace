<?php

use yii\db\Schema;
use yii\db\Migration;

class m150127_090809_UpdatePostDateColumnTypeForNewsTable extends Migration
{
    private $_table     = '_news';
    private $_column    = 'post_date';

    public function up()
    {
        $this->alterColumn($this->_table, $this->_column, Schema::TYPE_DATE . ' NOT NULL');
    }

    public function down()
    {
        $this->alterColumn($this->_table, $this->_column, Schema::TYPE_STRING . ' NOT NULL');
    }
}
