<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "_reviews_types".
 *
 * @property integer $id
 * @property string $title
 * @property integer $created_at
 * @property integer $updated_at
 */
class ReviewsTypes extends \app\components\ActiveRecord
{
    const AMPLIFIER     = 1;
    const SPEAKER       = 2;
    const DIGITAL       = 3;
    const CABLE         = 4;
    const ANALOG        = 5;
    const ACCESSORIES   = 6;
    const SURROUND      = 7;
    const DVD           = 8;
    const IMAGE         = 9;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '_reviews_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
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
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
