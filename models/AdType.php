<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ad_type".
 *
 * @property integer $id
 * @property string $title
 * @property integer $created_at
 * @property integer $updated_at
 */
class AdType extends \app\components\ActiveRecord
{
    const SELL      = 1;
    const BUY       = 2;
    const EXCHANGE  = 3;
    const UNKNOWN   = 4;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ad_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 100],
            [['title'], 'unique']
        ];
    }

    /**
     * Retrieve data (id and title)
     * @return array
     */
    public function prepareList()
    {
        $data = (new \yii\db\Query())
            ->select('id, title')
            ->from($this->tableName())
            ->where('id < 4')
            ->orderBy('id ASC')
            ->all();
        return ArrayHelper::map($data, 'id', 'title');
    }

    /**
     * Build relation with Item model
     * @return ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['ad_type_id' => 'id'])->orderBy('created_at ASC');
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
