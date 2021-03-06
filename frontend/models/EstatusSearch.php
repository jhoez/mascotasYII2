<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Estatus;

/**
 * EstatusSearch represents the model behind the search form of `frontend\models\Estatus`.
 */
class EstatusSearch extends Estatus
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idestatus', 'id_padre', 'cant_hijos'], 'integer'],
            [['nombre'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Estatus::find();

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
            'idestatus' => $this->idestatus,
            'id_padre' => $this->id_padre,
            'cant_hijos' => $this->cant_hijos,
        ]);

        $query->andFilterWhere(['ilike', 'nombre', $this->nombre]);

        return $dataProvider;
    }
}
