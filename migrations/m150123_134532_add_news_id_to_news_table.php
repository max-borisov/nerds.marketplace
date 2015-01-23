<?php

use yii\db\Schema;
use yii\db\Migration;

class m150123_134532_add_news_id_to_news_table extends Migration
{
    private $_table = '_news';

    public function up()
    {
        $this->addColumn($this->_table, 'news_id', 'integer NOT NULL DEFAULT 0 AFTER site_id');
    }

    public function down()
    {
        $this->dropColumn($this->_table, 'news_id');
    }
}
