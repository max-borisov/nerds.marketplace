<?php

use yii\db\Schema;
use yii\db\Migration;

class m150205_141122_add_new_review_type_to_reviews_table extends Migration
{
    private $_table = '_reviews_types';
    private $_id = 10;

    public function up()
    {
        $time = time();
        $this->insert($this->_table, [
            'id'    => $this->_id,
            'title' => 'Unknown',
            'created_at' => $time,
            'updated_at' => $time,
        ]);
    }

    public function down()
    {
        $this->delete($this->_table, 'id = ' . $this->_id);
    }
}
