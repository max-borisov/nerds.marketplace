<?php

namespace app\models;

use Yii;
use app\models\Item;
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
    const HIFI4ALL = 5;

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
            [['title'], 'string', 'max' => 255],
            [['title'], 'unique']
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
     * Build relation with Item model
     * @return ActiveQuery
     */
    public function getAttachedItems()
    {
        return $this->hasMany(Item::className(), ['category_id' => 'id'])->orderBy('updated_at DESC');
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title:',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function afterDelete()
    {
        parent::afterDelete();

        // Set category as zero for all related items
        $sql = 'UPDATE item SET category_id = 0, updated_at = :time WHERE category_id = :category_id';
        $command = Yii::$app->db->createCommand($sql);
        $command->bindValue(':category_id', $this->id);
        $command->bindValue(':time', time());
        $command->execute();
    }
}
