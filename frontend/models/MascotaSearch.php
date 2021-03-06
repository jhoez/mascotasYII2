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
    public $idtipo;
    //public $tratam;
    //public $discap;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['tratam','discap'],'string', 'max' => 255],
            [['idtipo','idmascota', 'idespecies', 'idprocedencia', 'idpropietario', 'sexo', 'statusvacunado', 'statusdesparacitado', 'statusdiscapacidad', 'statustratamiento', 'statusesterilizado'], 'integer'],
            [['nombre', 'edad'], 'safe'],
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
        $query = Mascota::find()->joinWith('tipomascota');
        //->joinWith('nombdiscapacidad')
        //->joinWith('nombtratamiento');

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
            'statusvacunado' => $this->statusvacunado,
            'statusdesparacitado' => $this->statusdesparacitado,
            'statusdiscapacidad' => $this->statusdiscapacidad,
            'statustratamiento' => $this->statustratamiento,
            'statusesterilizado' => $this->statusesterilizado,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'idtipo' => $this->idtipo,//agregada
        ]);

        $query->andFilterWhere(['ilike', 'nombre', $this->nombre])
            ->andFilterWhere(['ilike', 'edad', $this->edad]);
            //->andFilterWhere(['ilike', 'tratam', $this->tratam])
            //->andFilterWhere(['ilike', 'discap', $this->discap]);

        return $dataProvider;
    }
}
