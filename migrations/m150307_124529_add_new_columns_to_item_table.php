<?php

use yii\db\Schema;
use yii\db\Migration;

class m150307_124529_add_new_columns_to_item_table extends Migration
{
    private $_table = 'item';

    public function safeUp()
    {
        $this->addColumn($this->_table, 'music_artist',         Schema::TYPE_STRING . ' NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 'media_features',       Schema::TYPE_STRING . ' NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 'media_inches',         Schema::TYPE_STRING . ' NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 'media_size',           Schema::TYPE_STRING . ' NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 'eq_capacity',          Schema::TYPE_STRING . ' NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 'hd_capacity',          Schema::TYPE_STRING . ' NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 'camera_resolution',    Schema::TYPE_STRING . ' NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 'optical_zoom',         Schema::TYPE_STRING . ' NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 'speaker',              Schema::TYPE_STRING . ' NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 'speaker_type',         Schema::TYPE_STRING . ' NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 'channels',             Schema::TYPE_STRING . ' NOT NULL DEFAULT ""');
    }

    public function safeDown()
    {
        $this->dropColumn($this->_table, 'music_artist');
        $this->dropColumn($this->_table, 'media_features');
        $this->dropColumn($this->_table, 'media_inches');
        $this->dropColumn($this->_table, 'media_size');
        $this->dropColumn($this->_table, 'eq_capacity');
        $this->dropColumn($this->_table, 'hd_capacity');
        $this->dropColumn($this->_table, 'camera_resolution');
        $this->dropColumn($this->_table, 'optical_zoom');
        $this->dropColumn($this->_table, 'speaker');
        $this->dropColumn($this->_table, 'speaker_type');
        $this->dropColumn($this->_table, 'channels');
    }
}
