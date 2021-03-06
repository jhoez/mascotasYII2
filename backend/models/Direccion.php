<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "direccion".
 *
 * @property int $iddireccion
 * @property int $idpropietario
 * @property int $idislas
 * @property int|null $ncasa
 * @property int $id_calle
 *
 * @property CarnetCalle $calle
 * @property Islas $idislas0
 * @property Propietario $idpropietario0
 */
class Direccion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'direccion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idpropietario', 'idislas', 'id_calle'], 'required'],
            [['idpropietario', 'idislas', 'ncasa', 'id_calle'], 'default', 'value' => null],
            [['idpropietario', 'idislas', 'ncasa', 'id_calle'], 'integer'],
            [['id_calle'], 'exist', 'skipOnError' => true, 'targetClass' => CarnetCalle::className(), 'targetAttribute' => ['id_calle' => 'id']],
            [['idislas'], 'exist', 'skipOnError' => true, 'targetClass' => Islas::className(), 'targetAttribute' => ['idislas' => 'idislas']],
            [['idpropietario'], 'exist', 'skipOnError' => true, 'targetClass' => Propietario::className(), 'targetAttribute' => ['idpropietario' => 'idpropietario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iddireccion' => 'Iddireccion',
            'idpropietario' => 'Idpropietario',
            'idislas' => 'Idislas',
            'ncasa' => 'Ncasa',
            'id_calle' => 'Id Calle',
        ];
    }

    /**
     * Gets query for [[Calle]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCalle()
    {
        return $this->hasOne(CarnetCalle::className(), ['id' => 'id_calle']);
    }

    /**
     * Gets query for [[Idislas0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdislas0()
    {
        return $this->hasOne(Islas::className(), ['idislas' => 'idislas']);
    }

    /**
     * Gets query for [[Idpropietario0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdpropietario0()
    {
        return $this->hasOne(Propietario::className(), ['idpropietario' => 'idpropietario']);
    }
}
