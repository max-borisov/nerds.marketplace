<?php

use yii\db\Schema;
use yii\db\Migration;

class m150213_161735_add_item_table extends Migration
{
    private $_table = 'item';

    public function up()
    {
        $this->createTable($this->_table, [
            'id'            => 'pk',
            'warranty'      => Schema::TYPE_SMALLINT . ' NOT NULL',
            'invoice'       => Schema::TYPE_SMALLINT . ' NOT NULL',
            'packaging'     => Schema::TYPE_SMALLINT . ' NOT NULL',
            'manual'        => Schema::TYPE_SMALLINT . ' NOT NULL',
            'price'         => Schema::TYPE_DECIMAL . ' NOT NULL',
            'category_id'   => Schema::TYPE_SMALLINT . ' NOT NULL',
            'title'         => Schema::TYPE_STRING . ' NOT NULL',
            'user_id'       => Schema::TYPE_INTEGER . ' NOT NULL',
            'type_id'       => Schema::TYPE_SMALLINT . ' NOT NULL',
            'description'   => Schema::TYPE_TEXT . ' NOT NULL',
            'created_at'    => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at'    => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

        $this->addColumn($this->_table, 'site_id', 'integer NOT NULL DEFAULT 0');
        $this->addColumn($this->_table, 's_item_id', 'integer NOT NULL DEFAULT 0');
        $this->addColumn($this->_table, 's_user', 'string NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_location', 'string NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_phone', 'string NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_email', 'string NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_type', 'string NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_adv', 'string NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_date', 'date NOT NULL');
        $this->addColumn($this->_table, 's_preview', 'string NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_age', 'string NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_warranty', 'string NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_package', 'string NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_delivery', 'string NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_akn', 'string NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_manual', 'string NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_expires', 'string NOT NULL DEFAULT ""');

        $this->createIndex('index_site_id', $this->_table, 'site_id');
    }

    public function down()
    {
        $this->dropIndex('index_site_id', $this->_table);
        $this->dropTable($this->_table);
    }
}
