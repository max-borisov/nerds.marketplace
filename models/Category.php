<?php

namespace app\models;

use Yii;
use app\models\UsedItems;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $title
 * @property integer $created_at
 * @property integer $updated_at
 */
class Category extends \app\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
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
     * Retrieve data for drop down list
     * @return array
     */
    public function prepareDropDown()
    {
        $data = (new \yii\db\Query())
            ->select('id, title')
            ->from($this->tableName())
            ->orderBy('id ASC')
            ->all();
        return ArrayHelper::map($data, 'id', 'title');
    }

    /**
     * Build relation with UsedItems model
     * @return ActiveQuery
     */
    public function getAttachedItems()
    {
        return $this->hasMany(UsedItems::className(), ['category_id' => 'id']);
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
