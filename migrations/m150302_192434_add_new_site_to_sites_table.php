<?php

use yii\db\Schema;
use yii\db\Migration;

class m150302_192434_add_new_site_to_sites_table extends Migration
{
    private $_table = 'site';

    public function up()
    {
        $this->insert($this->_table, ['id' => 4, 'title' => 'Nerds']);
    }

    public function down()
    {
        $this->delete($this->_table, 'id = 4');
    }
}
