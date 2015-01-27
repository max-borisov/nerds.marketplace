<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "_reviews".
 *
 * @property integer $id
 * @property integer $site_id
 * @property integer $review_id
 * @property string $title
 * @property string $af
 * @property string $notice
 * @property string $post
 * @property string $post_date
 * @property integer $created_at
 * @property integer $updated_at
 */
class Reviews extends \app\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '_reviews';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site_id', 'review_id', 'title', 'af', 'notice', 'post', 'post_date'], 'required'],
            [['site_id', 'review_id'], 'integer'],
            [['notice', 'post'], 'text'],
            [['post_date'], 'safe'],
            [['title', 'af'], 'string', 'max' => 255]
        ];
    }

    public function beforeSave($insert)
    {
        $this->title    = iconv('latin1', 'utf8', $this->title);
        $this->af       = iconv('latin1', 'utf8', $this->af);
        $this->notice   = iconv('latin1', 'utf8', $this->notice);
        $this->post     = iconv('latin1', 'utf8', $this->post);
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'site_id' => 'Site ID',
            'review_id' => 'Review ID',
            'title' => 'Title',
            'af' => 'Af',
            'notice' => 'Notice',
            'post' => 'Post',
            'post_date' => 'Post Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
