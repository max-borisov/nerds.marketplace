<?php

namespace app\models;

use Yii;
use app\models\Category;

use app\components\Utility;

/**
 * This is the model class for table "used_items".
 *
 * @property integer $id
 * @property integer $warranty
 * @property integer $invoice
 * @property integer $packaging
 * @property integer $manual
 * @property string $price
 * @property integer $category_id
 * @property string $title
 * @property integer $user_id
 * @property integer $type_id
 * @property string $description
 */
class UsedItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'used_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['warranty', 'invoice', 'packaging', 'manual', 'price', 'category_id', 'title', 'type_id', 'description'], 'required'],
            [['warranty', 'invoice', 'packaging', 'manual', 'category_id', 'type_id'], 'integer'],
            [['price'], 'number'],
            [['title'], 'string', 'max' => 255],
            [['description'], 'string'],
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'warranty' => 'Warranty:',
            'invoice' => 'Invoice:',
            'packaging' => 'Packaging:',
            'manual' => 'Manual:',
            'price' => 'Price:',
            'category_id' => 'Category:',
            'title' => 'Title:',
            'user_id' => 'User ID',
            'type_id' => 'Type:',
            'description' => 'Description:',
        ];
    }

    public function search($params)
    {
        if (!($this->load($params) || !$this->validate())) {
            return false;
        }

        $query = UsedItems::find();

        $query->andFilterWhere([
            'warranty'  => $this->warranty,
            'packaging' => $this->packaging,
            'manual'    => $this->manual,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        /*$query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);*/

        return $query->all();
    }
}
