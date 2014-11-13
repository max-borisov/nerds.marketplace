<?php

use yii\db\Schema;
use yii\db\Migration;

class m141113_091136_update_used_item_table_delete_column extends Migration
{
    private $_table = 'used_items';

    public function up()
    {
        $this->dropColumn($this->_table, 'preview');
    }

    public function down()
    {
        echo "m141113_091136_update_used_item_table_delete_column cannot be reverted.\n";

        return false;
    }
}
