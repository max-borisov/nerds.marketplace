<?php

use yii\db\Schema;
use yii\db\Migration;

class m150116_111635_AddHiFiToSites extends Migration
{
    private $_table = '_sites';

    public function up()
    {
        $this->insert($this->_table, ['title' => 'HiFi4All', 'id' => 1]);
    }

    public function down()
    {
        $this->delete($this->_table, 'id = 1');
    }
}
