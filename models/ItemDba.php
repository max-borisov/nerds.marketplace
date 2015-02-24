<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_dba".
 *
 * @property integer $id
 * @property integer $side
 * @property integer $item_id
 * @property integer $is_saved
 */
class ItemDba extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_dba';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['side', 'item_id'], 'required'],
            [['side', 'item_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'side' => 'Side',
            'item_id' => 'Item ID',
        ];
    }
}
