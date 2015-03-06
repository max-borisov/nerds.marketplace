<?php

use yii\db\Schema;
use yii\db\Migration;

class m150306_064711_update_category_table extends Migration
{
    private $_table = 'category';

    public function up()
    {
        $this->addColumn($this->_table, 'parent_id', Schema::TYPE_INTEGER . ' NOT NULL after title');
    }

    public function down()
    {
        $this->dropColumn($this->_table, 'parent_id');
    }
}
