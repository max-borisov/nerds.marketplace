<?php
namespace app\components;

use yii\behaviors\TimestampBehavior;

/**
 * Custom ActiveRecord
 *
 * Class ActiveRecord
 * @package app\components
 */
class ActiveRecord extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function count($condition = '')
    {
        $q = (new \yii\db\Query())
            ->select('id')
            ->from($this->tableName());
        if ($condition) {
            $q->where($condition);
        }
        return $q->count();
    }
}