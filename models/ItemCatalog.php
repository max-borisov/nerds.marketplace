<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_catalog".
 *
 * @property integer $id
 * @property integer $side
 * @property integer $num
 */
class ItemCatalog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_catalog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['side', 'num'], 'required'],
            [['side', 'num'], 'integer']
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
            'num' => 'Num',
        ];
    }
}
