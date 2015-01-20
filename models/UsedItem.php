<?php

namespace app\models;

use Yii;
use app\models\Category;
use app\models\UsedItemPhoto;
use app\components\HelperBase;
use app\components\HelperMarketPlace;
use app\components\HelperUser;
use yii\base\Exception;

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
 * @property string $preview
 * @property string $price_min
 * @property string $price_max
 * @property integer s_id
 * @property string s_item_id
 * @property string s_user
 * @property string s_location
 * @property string s_phone
 * @property string s_email
 * @property string s_type
 * @property string s_adv
 * @property string s_date
 * @property string s_preview
 * @property string s_age
 * @property string s_warranty
 * @property string s_package
 * @property string s_delivery
 * @property string s_akn
 * @property string s_manual
 * @property string s_expires
 */
class UsedItem extends \app\components\ActiveRecord
{
    public $price_min;
    public $price_max;
    public $preview;
    public $search_text;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '_used_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['warranty', 'invoice', 'packaging', 'manual', 'price', 'category_id', 'title', 'type_id', 'description'], 'required', 'on' => ['create', 'edit']],
            [['title', 'category_id', 'type_id', 'description'], 'required', 'on' => ['create', 'edit']],
            [['warranty', 'invoice', 'packaging', 'manual', 'category_id', 'type_id'], 'integer', 'on' => ['create', 'edit']],
            [['price'], 'number', 'on' => ['create', 'edit']],
            [['price'], 'default', 'value' => 0, 'on' => ['create', 'edit']],
            [['title'], 'string', 'max' => 255, 'on' => ['create', 'edit']],
            [['description'], 'string', 'on' => ['create', 'edit']],

            [['title', 'description'], 'filter', 'filter' => function ($value) {
                    return trim(strip_tags($value));
            }, 'on' => ['create', 'edit']],

            [['warranty', 'packaging', 'manual', 'type_id'], 'integer', 'on' => ['search']],
            [['search_text'], 'string', 'max' => 255, 'on' => ['search']],
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
     * Build relation with UsedItemPhoto model
     * @return ActiveQuery
     */
    public function getPhotos()
    {
        return $this->hasMany(UsedItemPhoto::className(), ['item_id' => 'id'])->orderBy('updated_at DESC');
    }

    public function getUser()
    {
        return $this->hasOne(PhpbbUser::className(), ['user_id' => 'user_id']);
    }

    public function getType()
    {
        return $this->hasOne(UsedItemType::className(), ['id' => 'type_id']);
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
            'search_text' => 'Search text:',
            'user_id' => 'User id',
            'type_id' => 'Type:',
            'description' => 'Description:',
            'price_min' => 'Min price:',
            'price_max' => 'Max price:',
            'created_at' => 'Post date:',

            // Parsed data
            's_user' => 'User:',
            's_location' => 'Location:',
            's_phone' => 'Phone:',
            's_email' => 'Email:',
            's_adv' => 'Advertisement:',
            's_age' => 'Age:',
            's_warranty' => 'Warranty:',
            's_package' => 'Package:',
            's_delivery' => 'Delivery:',
            's_manual' => 'Manual:',
            's_akn' => 'Receipt:',
            's_expires' => 'Expires:',
        ];
    }

    /**
     * Apply search filter for items
     * @param array $params Get parameters (form data)
     * @return array|bool|\yii\db\ActiveRecord[]
     */
    public function search($params)
    {
        if (!($this->load($params) || !$this->validate())) {
            return false;
        }

        $this->price_min = Yii::$app->request->get('UsedItem')['price_min'];
        $this->price_max = Yii::$app->request->get('UsedItem')['price_max'];

        $query = UsedItem::find();
        $query->andFilterWhere([
            'warranty'  => $this->warranty,
            'packaging' => $this->packaging,
            'manual'    => $this->manual,
            'type_id'   => $this->type_id,
        ]);
        $query->andFilterWhere(['>=', 'price', $this->price_min]);
        $query->andFilterWhere(['<=', 'price', $this->price_max]);
        $query->andFilterWhere(['like', 'title', $this->search_text]);
        $query->orFilterWhere(['like', 'description', $this->search_text]);

        /*$query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);*/

        // Only items related to active categories
        $query->andWhere('category_id > 0');
        $query->orderBy(HelperMarketPlace::getSortParamForItemsList());
        return $query;
    }

    public function beforeSave($insert)
    {
        if (empty($this->user_id)) {
            throw new Exception('User id cannot be blank.');
        }
        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        // Set preview for each item
        // Default(blank) preview
        $this->preview = HelperBase::getParam('thumb')['placeholder'];

        if (!empty($this->s_preview) && $this->s_id == ExternalSite::HIFI4ALL) {
            $this->preview = HelperBase::getParam('HiFi4AllPic') . '/' . $this->s_preview;
        }

        if (($photos = $this->photos) && is_array($photos)) {
            $photoName = $photos[0]->name;
            $photoPath =
                Yii::getAlias('@photo_thumb_path')
                . '/'
                . $photoName;
            if (file_exists($photoPath)) {
                $this->preview =
                    Yii::getAlias('@photo_thumb_url')
                    . '/'
                    . $photoName;
            }
        }
        parent::afterFind();
    }

    public function beforeDelete()
    {
        // Get related photo models and delete them
        foreach ($this->photos as $photoModel) {
            if (!$photoModel->delete()) {
                throw new Exception('Photo model with id ' . $photoModel->id . ' could not be deleted.');
            }
        }

        return parent::beforeDelete();
    }
}
