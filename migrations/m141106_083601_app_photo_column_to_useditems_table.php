<?php

use yii\db\Schema;
use yii\db\Migration;

class m141106_083601_app_photo_column_to_useditems_table extends Migration
{
    private $_table     = 'used_items';
    private $_column    = 'preview';

    public function up()
    {
        $this->addColumn($this->_table, $this->_column, Schema::TYPE_STRING . ' NOT NULL');
    }

    public function down()
    {
        $this->dropColumn($this->_table, $this->_column);
    }
}
