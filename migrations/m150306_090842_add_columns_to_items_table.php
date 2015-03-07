<?php

use yii\db\Schema;
use yii\db\Migration;

class m150306_090842_add_columns_to_items_table extends Migration
{
    private $_table = 'item';

    public function safeUp()
    {
        $this->addColumn($this->_table, 'media_title',      Schema::TYPE_STRING . ' NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 'media_genre',      Schema::TYPE_STRING . ' NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 'media_type',       Schema::TYPE_STRING . ' NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 'media_producer',   Schema::TYPE_STRING . ' NOT NULL DEFAULT ""');
    }

    public function safeDown()
    {
        $this->dropColumn($this->_table, 'media_title');
        $this->dropColumn($this->_table, 'media_genre');
        $this->dropColumn($this->_table, 'media_type');
        $this->dropColumn($this->_table, 'media_producer');
    }
}
