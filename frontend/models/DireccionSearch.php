<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Direccion;

/**
 * DireccionSearch represents the model behind the search form of `frontend\models\Direccion`.
 */
class DireccionSearch extends Direccion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iddireccion', 'idpropietario', 'idislas', 'ncasa', 'id_calle'], 'integer'],
            [['iddireccion', 'idpropietario', 'idislas', 'ncasa', 'id_calle'], 'safe'],
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
        $query = Direccion::find();

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
            'iddireccion' => $this->iddireccion,
            'idpropietario' => $this->idpropietario,
            'idislas' => $this->idislas,
            'ncasa' => $this->ncasa,
            'id_calle' => $this->id_calle,
        ]);

        return $dataProvider;
    }
}
