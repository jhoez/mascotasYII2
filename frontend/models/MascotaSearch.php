<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Mascota;

/**
 * MascotaSearch represents the model behind the search form of `frontend\models\Mascota`.
 */
class MascotaSearch extends Mascota
{
    public $cedula;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idmascota', 'idespecies', 'idprocedencia', 'idpropietario', 'sexo', 'vacuna_antirab', 'desparacitado', 'discapacidad', 'tratamiento', 'esterelizado'], 'integer'],
<<<<<<< HEAD
            [['nombre','sexo', 'edad'], 'safe'],
=======
            [['nombre', 'edad', 'created_by', 'created_at', 'updated_by', 'updated_at','cedula'], 'safe'],
>>>>>>> de8f2512896ab5cdeea6d9077187944d22023e37
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
        $query = Mascota::find()
        ->innerJoinWith('idpropietario');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder'=>['idmascota'=>SORT_DESC]
            ],
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idmascota' => $this->idmascota,
            'idespecies' => $this->idespecies,
            'idprocedencia' => $this->idprocedencia,
            'idpropietario' => $this->idpropietario,
            'sexo' => $this->sexo,
            'vacuna_antirab' => $this->vacuna_antirab,
            'desparacitado' => $this->desparacitado,
            'discapacidad' => $this->discapacidad,
            'tratamiento' => $this->tratamiento,
            'esterelizado' => $this->esterelizado,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['ilike', 'nombre', $this->nombre])
<<<<<<< HEAD
            ->andFilterWhere(['ilike', 'edad', $this->edad]);
=======
            ->andFilterWhere(['ilike', 'edad', $this->edad])
            ->andFilterWhere(['ilike', 'created_by', $this->created_by])
            ->andFilterWhere(['ilike', 'updated_by', $this->updated_by])
            ->andFilterWhere(['ilike', 'idpropietario.cedula', $this->cedula]);
>>>>>>> de8f2512896ab5cdeea6d9077187944d22023e37

        return $dataProvider;
    }
}
