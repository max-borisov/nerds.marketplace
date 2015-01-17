<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "_sites".
 *
 * @property integer $id
 * @property string $title
 */
class ExternalSite extends \yii\db\ActiveRecord
{
    const HIFI4ALL = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '_sites';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }
}
