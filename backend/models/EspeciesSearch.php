<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Especies;

/**
 * EspeciesSearch represents the model behind the search form of `backend\models\Especies`.
 */
class EspeciesSearch extends Especies
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idespecies', 'idtipo'], 'integer'],
            [['raza', 'color'], 'safe'],
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
        $query = Especies::find();

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
            'idespecies' => $this->idespecies,
            'idtipo' => $this->idtipo,
        ]);

        $query->andFilterWhere(['ilike', 'raza', $this->raza])
            ->andFilterWhere(['ilike', 'color', $this->color]);

        return $dataProvider;
    }
}
