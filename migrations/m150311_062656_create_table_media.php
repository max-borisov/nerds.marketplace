<?php

use yii\db\Schema;
use yii\db\Migration;

class m150311_062656_create_table_media extends Migration
{
    private $_table = 'media';

    public function safeUp()
    {
        $this->createTable($this->_table, [
            'id'            => 'pk',
            'site_id'       => Schema::TYPE_INTEGER . ' NOT NULL',
            'article_id'    => Schema::TYPE_INTEGER . ' NOT NULL',
            'title'         => Schema::TYPE_STRING . ' NOT NULL',
            'post'          => Schema::TYPE_TEXT . ' NOT NULL',
            'post_date'     => Schema::TYPE_DATE . ' NOT NULL',

            'created_at'    => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at'    => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

        $this->createIndex('index_site_id', $this->_table, 'site_id');
        $this->createIndex('index_post_date', $this->_table, 'post_date');
        $this->createIndex('index_site_id_article_id', $this->_table, 'site_id, article_id', true);
    }

    public function safeDown()
    {
        $this->dropIndex('index_site_id', $this->_table);
        $this->dropIndex('index_post_date', $this->_table);
        $this->dropIndex('index_site_id_article_id', $this->_table);

        $this->dropTable($this->_table);
    }
}
