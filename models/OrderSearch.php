<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Order;

/**
 * OrderSearch represents the model behind the search form about `app\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status_id', 'from_point_id', 'to_point_id', 'car_class_id', 'car_id', 'tariff_id', 'passengers', 'driver_id', 'client_id'], 'integer'],
            [['date_create', 'date_update', 'text_table', 'comment'], 'safe'],
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
        $query = Order::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
            'datetime_booking' => $this->datetime_booking,
            'status_id' => $this->status_id,
            'from_point_id' => $this->from_point_id,
            'to_point_id' => $this->to_point_id,
            'car_class_id' => $this->car_class_id,
            'car_id' => $this->car_id,
            'tariff_id' => $this->tariff_id,
            'passengers' => $this->passengers,
	        'client_id' => $params['client_id'],
	        'driver_id' => $this->driver_id
        ]);

        $query->andFilterWhere(['like', 'text_table', $this->text_table])
            ->andFilterWhere(['like', 'comment', $this->comment]);

	    $query->orderBy('id DESC');

        return $dataProvider;
    }
}
