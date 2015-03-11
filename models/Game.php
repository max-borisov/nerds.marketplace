<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "game".
 *
 * @property integer $id
 * @property integer $site_id
 * @property integer $article_id
 * @property string $title
 * @property string $post
 * @property string $post_date
 * @property integer $created_at
 * @property integer $updated_at
 */
class Game extends \app\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game';
    }

    public function beforeSave($insert)
    {
        $this->title    = iconv('latin1', 'utf8', $this->title);
        $this->post     = iconv('latin1', 'utf8', $this->post);
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site_id', 'article_id', 'title', 'post', 'post_date', 'created_at', 'updated_at'], 'required'],
            [['site_id', 'article_id', 'created_at', 'updated_at'], 'integer'],
            [['post'], 'string'],
            [['post_date'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['site_id', 'article_id'], 'unique', 'targetAttribute' => ['site_id', 'article_id'], 'message' => 'The combination of Site ID and Article ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'site_id' => 'Site ID',
            'article_id' => 'Article ID',
            'title' => 'Title',
            'post' => 'Post',
            'post_date' => 'Post Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
