<?php

namespace app\models;

use Yii;
use app\models\Category;
use app\models\ItemPhoto;
use app\components\HelperBase;
use app\components\HelperMarketPlace;
use app\components\HelperUser;
use yii\base\Exception;

/**
 * This is the model class for table "item".
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
 * @property integer $site_id
 * @property string $s_item_id
 * @property string $s_user
 * @property string $s_location
 * @property string $s_phone
 * @property string $s_email
 * @property string $s_type
 * @property string $s_adv
 * @property string $s_date
 * @property string $s_preview
 * @property string $s_age
 * @property string $s_warranty
 * @property string $s_package
 * @property string $s_delivery
 * @property string $s_akn
 * @property string $s_manual
 * @property string $s_expires
 * @property string $s_brand
 * @property string $s_model
 * @property string $s_producer
 * @property string $s_watt
 * @property string $s_product
 */
class Item extends \app\components\ActiveRecord
{
    const YES_FLAG  = 1;
    const NO_FLAG   = 0;
    const NA_FLAG   = 2;

    public $price_min;
    public $price_max;
    public $preview;
    public $search_text;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item';
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
     * Build relation with ItemPhoto model
     * @return ActiveQuery
     */
    public function getPhotos()
    {
        return $this->hasMany(ItemPhoto::className(), ['item_id' => 'id'])->orderBy('updated_at DESC');
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getType()
    {
        return $this->hasOne(ItemType::className(), ['id' => 'type_id']);
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
            'type_id' => 'Ad type:',
            'description' => 'Description:',
            'price_min' => 'Min price:',
            'price_max' => 'Max price:',
            'created_at' => 'Created:',

            // Parsed data
            's_user' => 'User:',
            's_location' => 'Location:',
            's_phone' => 'Phone:',
            's_email' => 'Email:',
            's_adv' => 'Advertisement:',
            's_age' => 'Age:',
            's_date' => 'Post date:',
            's_warranty' => 'Warranty:',
            's_package' => 'Package:',
            's_delivery' => 'Delivery:',
            's_manual' => 'Manual:',
            's_akn' => 'Receipt:',
            's_expires' => 'Expires:',

            's_brand' => 'Brand:',
            's_model' => 'Model:',
            's_producer' => 'Producer:',
            's_watt' => 'Watt:',
            's_product' => 'Product:',
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

        $this->price_min = Yii::$app->request->get('Item')['price_min'];
        $this->price_max = Yii::$app->request->get('Item')['price_max'];
        $price_min = (int)$this->price_min;
        $price_max = (int)$this->price_max;

//        HelperBase::dump($this->price_min);
//        HelperBase::dump($this->price_max);

//        HelperBase::dump($this->type_id, true);

       /* $sql = '
        SELECT * FROM item
        WHERE
        type_id = :ad_id
        AND
            (warranty = :warranty OR warranty = :na_flag)
        AND
            (packaging = :packaging OR packaging = :na_flag)
        AND
            (manual = :manual OR manual = :na_flag)
        AND
            (price BETWEEN :price_min AND :price_max)
        AND
            (title LIKE "%:search_text%" OR description LIKE "%:search_text%")
        AND
            category_id > 0
        ORDER BY :order
        LIMIT 10
        ';*/
        $sql = '
        SELECT * FROM item
        WHERE
            IF (:ad_id > 0, type_id = :ad_id, 1)
        AND
            category_id > 0
        AND
            (warranty = :warranty OR warranty = :na_flag)
        AND
            (packaging = :packaging OR packaging = :na_flag)
        AND
            (manual = :manual OR manual = :na_flag)
        AND
            IF(:price_min > 0, price >= :price_min, 1)
        AND
            IF(:price_max > 0, price <= :price_max, 1)
        AND
            IF(:search_text != "", title LIKE "%:search_text%" OR description LIKE "%:search_text%", 1)
        ORDER BY :order
        LIMIT 10
        ';
        $query = Item::findBySql($sql, [
            ':ad_id' => (int)$this->type_id,
            ':warranty' => $this->warranty,
            ':packaging' => $this->packaging,
            ':manual' => $this->manual,
            ':price_min' => $price_min,
            ':price_max' => $price_max,
            ':search_text' => $this->search_text,
            ':na_flag'  => Item::NA_FLAG,
            ':order'  => HelperMarketPlace::getSortParamForItemsList()
        ]);

//        HelperBase::dump($query->sql);
//        HelperBase::dump($query->all());

        /*$query = Item::find();
        $query->andFilterWhere([
            'warranty'  => $this->warranty,
            'packaging' => $this->packaging,
            'manual'    => $this->manual,
            'type_id'   => $this->type_id,
        ]);
        HelperBase::dump($query, true);


        $query->andFilterWhere(['>=', 'price', $this->price_min]);
        $query->andFilterWhere(['<=', 'price', $this->price_max]);
        $query->andFilterWhere(['like', 'title', $this->search_text]);
        $query->orFilterWhere(['like', 'description', $this->search_text]);*/

        /*$query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);*/

        // Only items related to active categories
//        $query->andWhere('category_id > 0');
//        $query->orderBy(HelperMarketPlace::getSortParamForItemsList());



        return $query;
    }

    public function beforeSave($insert)
    {
        if (!isset($this->user_id)) {
            throw new Exception('User id cannot be blank.');
        }
        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        // Set preview for each item
        // Default(blank) preview
        $this->preview = HelperBase::getParam('thumb')['placeholder'];

        if (!empty($this->s_preview) && $this->site_id == ExternalSite::HIFI4ALL) {
            $this->preview = HelperBase::getParam('HiFi4AllPic') . '/' . $this->s_preview;
        }
        if (!empty($this->s_preview) && $this->site_id == ExternalSite::DBA) {
            $this->preview = $this->s_preview;
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
