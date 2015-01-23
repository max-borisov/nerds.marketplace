<?php

use yii\db\Schema;
use yii\db\Migration;

class m150123_145608_add_news_date_to_news_table extends Migration
{
    private $_table = '_news';

    public function up()
    {
        $this->addColumn($this->_table, 'post_date', 'string NOT NULL DEFAULT "" AFTER post');
    }

    public function down()
    {
        $this->dropColumn($this->_table, 'post_date');
    }
}
