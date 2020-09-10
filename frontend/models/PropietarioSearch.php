<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Propietario;

/**
 * PropietarioSearch represents the model behind the search form of `frontend\models\Propietario`.
 */
class PropietarioSearch extends Propietario
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idpropietario', 'cedula', 'id_persona_carnet'], 'integer'],
            [['nombres', 'apellidos', 'telefono', 'nacionalidad', 'correo'], 'safe'],
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
        $query = Propietario::find();

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
            'idpropietario' => $this->idpropietario,
            'cedula' => $this->cedula,
            'id_persona_carnet' => $this->id_persona_carnet,
        ]);

        $query->andFilterWhere(['ilike', 'nombres', $this->nombres])
            ->andFilterWhere(['ilike', 'apellidos', $this->apellidos])
            ->andFilterWhere(['ilike', 'telefono', $this->telefono])
            ->andFilterWhere(['ilike', 'nacionalidad', $this->nacionalidad])
            ->andFilterWhere(['ilike', 'correo', $this->correo]);

        return $dataProvider;
    }
}
