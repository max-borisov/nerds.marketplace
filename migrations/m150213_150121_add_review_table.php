<?php

use yii\db\Schema;
use yii\db\Migration;

class m150213_150121_add_review_table extends Migration
{
    private $_table = 'review';

    public function safeUp()
    {
        $this->createTable($this->_table, [
            'id'                => 'pk',
            'site_id'           => Schema::TYPE_INTEGER . ' NOT NULL',
            'review_id'         => Schema::TYPE_INTEGER . ' NOT NULL',
            'review_type_id'    => Schema::TYPE_INTEGER . ' NOT NULL',
            'title'             => Schema::TYPE_STRING . ' NOT NULL',
            'af'                => Schema::TYPE_STRING . ' NOT NULL',
            'notice'            => Schema::TYPE_TEXT . ' NOT NULL',
            'post'              => Schema::TYPE_TEXT . ' NOT NULL',
            'post_date'         => Schema::TYPE_DATE . ' NOT NULL',

            'created_at'    => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at'    => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

        $this->createIndex('index_site_id', $this->_table, 'site_id');
        $this->createIndex('index_post_date', $this->_table, 'post_date');
        $this->createIndex('index_site_id_review_id', $this->_table, 'site_id, review_id', true);
    }

    public function safeDown()
    {
        $this->dropIndex('index_site_id', $this->_table);
        $this->dropIndex('index_post_date', $this->_table);
        $this->dropIndex('index_site_id_review_id', $this->_table);

        $this->dropTable($this->_table);
    }
}
