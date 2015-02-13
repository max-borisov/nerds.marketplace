<?php

use yii\db\Schema;
use yii\db\Migration;

class m150213_163028_add_item_photo_table extends Migration
{
    private $_table = 'item_photo';

    public function safeUp()
    {
        $this->createTable($this->_table, [
            'id'            => 'pk',
            'item_id'       => Schema::TYPE_INTEGER . ' NOT NULL',
            'name'          => Schema::TYPE_TEXT    . ' NOT NULL',
            'created_at'    => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at'    => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

        $this->createIndex('index_item_id', $this->_table, 'item_id');
    }

    public function safeDown()
    {
        $this->dropIndex('index_item_id', $this->_table);
        $this->dropTable($this->_table);
    }
}
