<?php

use yii\db\Schema;
use yii\db\Migration;

class m150202_195148_add_new_row_to_sites_table extends Migration
{
    private $_table = '_sites';

    public function up()
    {
        $this->insert($this->_table, [
            'id' => 2,
            'title' => 'Recordere',
        ]);
    }

    public function down()
    {
        $this->delete($this->_table, 'id = 2');
    }
}
