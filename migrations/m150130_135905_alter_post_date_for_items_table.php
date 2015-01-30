<?php

use yii\db\Schema;
use yii\db\Migration;

class m150130_135905_alter_post_date_for_items_table extends Migration
{
    private $_table = '_used_item';

    public function up()
    {
        $this->alterColumn($this->_table, 's_date', Schema::TYPE_DATE . ' NOT NULL');
    }

    public function down()
    {
        echo "m150130_135905_alter_pSand
        sdcsd
        ate_for_items_table cannot be reverted.\n";
        return false;
    }
}
