<?php

use yii\db\Schema;
use yii\db\Migration;

class m150213_154501_add_review_type_table extends Migration
{
    private $_table = 'review_type';

    public function safeUp()
    {
        $this->createTable($this->_table, [
            'id'            => 'pk',
            'title'         => Schema::TYPE_STRING . ' NOT NULL',

            'created_at'    => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at'    => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

        $time = time();

        $this->insert($this->_table, [
            'id'            => 1,
            'title'         => 'Forstærker',
            'created_at'    => $time,
            'updated_at'    => $time,
        ]);
        $this->insert($this->_table, [
            'id'            => 2,
            'title'         => 'Højtaler',
            'created_at'    => $time,
            'updated_at'    => $time,
        ]);
        $this->insert($this->_table, [
            'id'            => 3,
            'title'         => 'Digital',
            'created_at'    => $time,
            'updated_at'    => $time,
        ]);
        $this->insert($this->_table, [
            'id'            => 4,
            'title'         => 'Kabel',
            'created_at'    => $time,
            'updated_at'    => $time,
        ]);
        $this->insert($this->_table, [
            'id'            => 5,
            'title'         => 'Analog',
            'created_at'    => $time,
            'updated_at'    => $time,
        ]);
        $this->insert($this->_table, [
            'id'            => 6,
            'title'         => 'Tilbehør',
            'created_at'    => $time,
            'updated_at'    => $time,
        ]);
        $this->insert($this->_table, [
            'id'            => 7,
            'title'         => 'Surround',
            'created_at'    => $time,
            'updated_at'    => $time,
        ]);
        $this->insert($this->_table, [
            'id'            => 8,
            'title'         => 'DVD',
            'created_at'    => $time,
            'updated_at'    => $time,
        ]);
        $this->insert($this->_table, [
            'id'            => 9,
            'title'         => 'Billede',
            'created_at'    => $time,
            'updated_at'    => $time,
        ]);
        $this->insert($this->_table, [
            'id'            => 10,
            'title'         => 'Unknown',
            'created_at'    => $time,
            'updated_at'    => $time,
        ]);
    }

    public function safeDown()
    {
        $this->delete($this->_table, 'id = 1');
        $this->delete($this->_table, 'id = 2');
        $this->delete($this->_table, 'id = 3');
        $this->delete($this->_table, 'id = 4');
        $this->delete($this->_table, 'id = 5');
        $this->delete($this->_table, 'id = 6');
        $this->delete($this->_table, 'id = 7');
        $this->delete($this->_table, 'id = 8');
        $this->delete($this->_table, 'id = 9');
        $this->delete($this->_table, 'id = 10');

        $this->dropTable($this->_table);
    }
}
