<?php

use yii\db\Schema;
use yii\db\Migration;

class m150123_133644_add_site_id_to_news_table extends Migration
{
    private $_table = '_news';

    public function up()
    {
        $this->addColumn($this->_table, 'site_id', 'integer NOT NULL DEFAULT 0 AFTER id');
    }

    public function down()
    {
        $this->dropColumn($this->_table, 'site_id');
    }
}
