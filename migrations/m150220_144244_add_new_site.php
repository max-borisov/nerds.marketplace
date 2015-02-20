<?php

use yii\db\Schema;
use yii\db\Migration;

class m150220_144244_add_new_site extends Migration
{
    private $_table = 'site';

    public function up()
    {
        $this->insert($this->_table, ['id' => '3', 'title' => 'Dba']);
    }

    public function down()
    {
        $this->delete($this->_table, 'id = 3');
    }
}
