<?php

use yii\db\Schema;
use yii\db\Migration;

class m141031_162713_create_used_items_table extends Migration
{
    private $_tableName = 'used_items';

    public function up()
    {
        $this->createTable($this->_tableName, [
            'id'            => 'pk',
            'warranty'      => \yii\db\oci\Schema::TYPE_SMALLINT . ' NOT NULL',
            'invoice'       => \yii\db\oci\Schema::TYPE_SMALLINT . ' NOT NULL',
            'packaging'     => \yii\db\oci\Schema::TYPE_SMALLINT . ' NOT NULL',
            'manual'        => \yii\db\oci\Schema::TYPE_SMALLINT . ' NOT NULL',
            'price'         => \yii\db\oci\Schema::TYPE_DECIMAL . ' NOT NULL',
            'category_id'   => \yii\db\oci\Schema::TYPE_SMALLINT . ' NOT NULL',
            'title'         => \yii\db\oci\Schema::TYPE_STRING . ' NOT NULL',
            'user_id'       => \yii\db\oci\Schema::TYPE_INTEGER . ' NOT NULL',
            'type_id'       => \yii\db\oci\Schema::TYPE_SMALLINT . ' NOT NULL',
            'description'   => \yii\db\oci\Schema::TYPE_TEXT . ' NOT NULL',
        ]);
    }

    public function down()
    {
        echo "m141031_162713_create_used_items_table cannot be reverted.\n";

        $this->dropTable($this->_tableName);

//        return false;
    }
}
