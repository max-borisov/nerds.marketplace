<?php

use yii\db\Schema;
use yii\db\Migration;

class m150220_133130_add_new_categories extends Migration
{
    private $_table = 'category';

    public function safeUp()
    {
        $this->insert($this->_table, ['id' => '6',  'title' => 'Højttalere, hi-fi']);
        $this->insert($this->_table, ['id' => '7',  'title' => 'Stereoanlæg']);
        $this->insert($this->_table, ['id' => '8',  'title' => 'Hovedtelefoner']);
        $this->insert($this->_table, ['id' => '9',  'title' => 'Radioer']);
        $this->insert($this->_table, ['id' => '10', 'title' => 'Pladespillere']);
        $this->insert($this->_table, ['id' => '11', 'title' => 'Cd-afspillere']);
        $this->insert($this->_table, ['id' => '12', 'title' => 'Mp3/Mp4-afspillere']);
        $this->insert($this->_table, ['id' => '13', 'title' => 'Båndoptagere']);
        $this->insert($this->_table, ['id' => '14', 'title' => 'Tilbehør til MP3-afspilllere']);
        $this->insert($this->_table, ['id' => '15', 'title' => 'Minidisc-afspillere']);

    }

    public function safeDown()
    {
        $this->delete($this->_table, 'id = 6');
        $this->delete($this->_table, 'id = 7');
        $this->delete($this->_table, 'id = 8');
        $this->delete($this->_table, 'id = 9');
        $this->delete($this->_table, 'id = 10');
        $this->delete($this->_table, 'id = 11');
        $this->delete($this->_table, 'id = 12');
        $this->delete($this->_table, 'id = 13');
        $this->delete($this->_table, 'id = 14');
        $this->delete($this->_table, 'id = 15');
    }
}
