<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UsedItems;

/**
 * UsedItemsSearch represents the model behind the search form about `app\models\UsedItems`.
 */
class UsedItemsSearch extends UsedItems
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'warranty', 'invoice', 'packaging', 'manual', 'category_id', 'user_id', 'type_id'], 'integer'],
            [['price'], 'number'],
            [['title', 'description'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = UsedItems::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'warranty' => $this->warranty,
            'invoice' => $this->invoice,
            'packaging' => $this->packaging,
            'manual' => $this->manual,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'user_id' => $this->user_id,
            'type_id' => $this->type_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
