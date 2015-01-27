<?php

use yii\db\Schema;
use yii\db\Migration;

class m150127_133248_create_reviews_table extends Migration
{
    private $_table = '_reviews';

    public function up()
    {
        $this->createTable($this->_table, [
            'id'        => 'pk',
            'site_id'   => \yii\db\oci\Schema::TYPE_INTEGER . ' NOT NULL',
            'review_id' => \yii\db\oci\Schema::TYPE_INTEGER . ' NOT NULL',
            'title'     => \yii\db\oci\Schema::TYPE_STRING . ' NOT NULL',
            'af'        => \yii\db\oci\Schema::TYPE_STRING . ' NOT NULL',
            'notice'    => \yii\db\oci\Schema::TYPE_TEXT . ' NOT NULL',
            'post'      => \yii\db\oci\Schema::TYPE_TEXT . ' NOT NULL',
            'post_date' => \yii\db\oci\Schema::TYPE_DATE . ' NOT NULL',

            'created_at'    => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at'    => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable($this->_table);
    }
}
