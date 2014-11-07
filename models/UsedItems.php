<?php

namespace app\models;

use Yii;
use app\models\Category;
use app\components\HelperBase;
use app\components\HelperMarketPlace;

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
 * @property string $file
 * @property string $preview
 * @property string $price_min
 * @property string $price_max
 */
class UsedItems extends \app\components\ActiveRecord
{
    public $file;

    public $price_min;
    public $price_max;

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
            [['warranty', 'invoice', 'packaging', 'manual', 'price', 'category_id', 'title', 'type_id', 'description', 'file'], 'required', 'on' => ['create']],
            [['warranty', 'invoice', 'packaging', 'manual', 'category_id', 'type_id'], 'integer', 'on' => ['create']],
            [['price'], 'number', 'on' => ['create']],
            [['title'], 'string', 'max' => 255, 'on' => ['create']],
            [['description'], 'string', 'on' => ['create']],
            [['file'], 'file', 'on' => ['create'], 'extensions' => 'jpg, gif, png'],

            [['price_min, price_max'], 'number', 'on' => ['search']],
        ];
    }

    /**
     * Build relation with Category model
     * @return ActiveQuery
     */
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
            'file' => 'File:',
            'price_min' => 'Min price:',
            'price_max' => 'Max price:',
        ];
    }

    /**
     * Apply search filter for items
     * @param $params
     * @return array|bool|\yii\db\ActiveRecord[]
     */
    public function search($params)
    {

        if (!($this->load($params) || !$this->validate())) {
            return false;
        }

        $this->price_min = Yii::$app->request->get('UsedItems')['price_min'];
        $this->price_max = Yii::$app->request->get('UsedItems')['price_max'];

        $query = UsedItems::find();
        $query->andFilterWhere([
            'warranty'  => $this->warranty,
            'packaging' => $this->packaging,
            'manual'    => $this->manual,
        ]);
        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['>=', 'price', $this->price_min]);
        $query->andFilterWhere(['<=', 'price', $this->price_max]);

        /*$query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);*/

        $query->orderBy('id DESC');
        return $query->all();
    }

    public function beforeSave($insert)
    {
        $this->preview = uniqid();
        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        HelperMarketPlace::saveItemPhoto($this, $this->file);
    }

    public function afterFind()
    {
        // Resolve preview name to full url
        if ($this->preview) {
            $this->preview = Yii::getAlias('@photo_thumb_url') . '/' . $this->preview . HelperBase::getParam('thumb')['extension'];
        } else {
            $this->preview = HelperBase::getParam('thumb')['placeholder'];
        }
        parent::afterFind();
    }
}
