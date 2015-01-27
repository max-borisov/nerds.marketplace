<?php

use yii\db\Schema;
use yii\db\Migration;

class m150127_163309_add_review_type_id_to_reviews_table extends Migration
{
    private $_table = '_reviews';

    public function up()
    {
        $this->addColumn($this->_table, 'review_type_id', Schema::TYPE_INTEGER . ' NOT NULL AFTER review_id');
    }

    public function down()
    {
        $this->dropColumn($this->_table, 'review_type_id');
    }
}
