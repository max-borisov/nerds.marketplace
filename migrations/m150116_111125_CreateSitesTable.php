<?php

use yii\db\Migration;

class m150116_111125_CreateSitesTable extends Migration
{
    private $_table = '_sites';

    public function up()
    {
        $this->createTable($this->_table, [
            'id' => 'pk',
            'title' => \yii\db\oci\Schema::TYPE_STRING . ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable($this->_table);
    }
}
