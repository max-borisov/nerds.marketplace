<?php

use yii\db\Schema;
use yii\db\Migration;

class m150302_105807_rename_item_item_types extends Migration
{
    public function up()
    {
        $this->renameTable('item_type', 'ad_type');
    }

    public function down()
    {
        $this->renameTable('ad_type', 'item_type');
    }
}
