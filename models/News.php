<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "_news".
 *
 * @property integer $id
 * @property string $title
 * @property string $af
 * @property string $notice
 * @property string $post
 * @property integer $created_at
 * @property integer $updated_at
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '_news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'af', 'notice', 'post'], 'required'],
            [['title', 'af', 'notice'], 'string', 'max' => 255, 'allowEmpty' => true],
            [['post'], 'string', 'allowEmpty' => true],
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
            'af' => 'Af',
            'notice' => 'Notice',
            'post' => 'Post',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
