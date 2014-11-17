<?php

use yii\db\Schema;
use yii\db\Migration;

class m141112_134017_create_table_used_item_photo extends Migration
{
    private $_table = '_used_item_photo';

    public function up()
    {
        $this->createTable($this->_table, [
            'id'            => 'pk',
            'item_id'       => \yii\db\oci\Schema::TYPE_INTEGER . ' NOT NULL',
            'name'          => \yii\db\oci\Schema::TYPE_TEXT . ' NOT NULL',
            'created_at'    => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at'    => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable($this->_table);
    }
}
