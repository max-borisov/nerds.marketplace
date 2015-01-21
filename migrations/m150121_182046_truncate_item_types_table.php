<?php

use yii\db\Schema;
use yii\db\Migration;

class m150121_182046_truncate_item_types_table extends Migration
{
    public function up()
    {
        $this->truncateTable('_used_item_type');
    }

    public function down()
    {
        echo "m150121_182046_truncate_item_types_table cannot be reverted.\n";
        return false;
    }
}
