<?php

use yii\db\Schema;
use yii\db\Migration;

class m150116_112105_add_new_columns_to_items_table extends Migration
{
    private $_table = '_used_item';

    public function up()
    {
        $this->addColumn($this->_table, 's_id', 'integer NOT NULL DEFAULT 0');
        $this->addColumn($this->_table, 's_user', 'string NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_location', 'string NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_phone', 'string NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_email', 'string NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_type', 'string NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_adv', 'string NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_date', 'string NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_preview', 'string NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_age', 'string NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_warranty', 'string NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_package', 'string NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_delivery', 'string NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_akn', 'string NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_manual', 'string NOT NULL DEFAULT ""');
        $this->addColumn($this->_table, 's_expires', 'string NOT NULL DEFAULT ""');
    }

    public function down()
    {
        $this->dropColumn($this->_table, 's_id');
        $this->dropColumn($this->_table, 's_user');
        $this->dropColumn($this->_table, 's_location');
        $this->dropColumn($this->_table, 's_phone');
        $this->dropColumn($this->_table, 's_email');
        $this->dropColumn($this->_table, 's_type');
        $this->dropColumn($this->_table, 's_adv');
        $this->dropColumn($this->_table, 's_date');
        $this->dropColumn($this->_table, 's_preview');
        $this->dropColumn($this->_table, 's_age');
        $this->dropColumn($this->_table, 's_warranty');
        $this->dropColumn($this->_table, 's_package');
        $this->dropColumn($this->_table, 's_delivery');
        $this->dropColumn($this->_table, 's_akn');
        $this->dropColumn($this->_table, 's_manual');
        $this->dropColumn($this->_table, 's_expires');
    }
}
