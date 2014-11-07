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
}