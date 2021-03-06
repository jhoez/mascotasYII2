<?php

namespace frontend\models;

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
        return 'regmasc.direccion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idislas', 'ncasa', 'id_calle'], 'required','message'=>"!Este campo no puede estar vacio¡"],
            [['idpropietario', 'idislas', 'ncasa', 'id_calle'], 'default', 'value' => null],
            [['iddireccion', 'idpropietario', 'idislas', 'ncasa', 'id_calle'], 'integer'],
            [['id_calle'], 'exist', 'skipOnError' => true, 'targetClass' => Calle::className(), 'targetAttribute' => ['id_calle' => 'id']],
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
    *   metodo para registrar DATOS de DIRECCION
    *   @return model
    *   @method registrar
    */
    public function registrar ($id)
    {
        $direccion = new Direccion;
        $direccion->idpropietario = $id;
        $direccion->idislas = $this->idislas;
        $direccion->ncasa = $this->ncasa;
        $direccion->id_calle = $this->id_calle;

        if ( $direccion->save() ) {
            return $direccion;
        }else {
            return false;
        }

    }

    /**
    *   metodo para actualizar DATOS de DIRECCION
    *   @return model | false
    *   @method actualizar
    */
    public function actualizar($propietario = null)
    {
        $direccion = Direccion::find()->where(['idpropietario'=>$propietario->idpropietario])->one();
        if (is_object($direccion)) {
        }else {
            $direccion = new Direccion;
            $direccion->idpropietario = $propietario->idpropietario;
        }
        $direccion->idislas = $this->idislas;
        $direccion->ncasa = $this->ncasa;
        $direccion->id_calle = $this->id_calle;

        if ( $direccion->save() ) {
            return $direccion;
        }else {
            return false;
        }

    }

    /**
     * Gets query for [[Calle]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirCalle()
    {
        //return $this->hasOne(Calle::className(), ['id' => 'id_calle']);
        $calle = Calle::find()->where(['id'=>$this->id_calle])->one();
        return $calle;
    }
    //
    public function getid_calle()
    {
        return $this->hasOne(Calle::className(), ['id' => 'id_calle']);
    }

    /**
     * Gets query for [[Idislas0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirIsla()
    {
        //return $this->hasOne(Islas::className(), ['idislas' => 'idislas']);
        $isla = Islas::find()->where(['idislas'=>$this->idislas])->one();
        return $isla;
    }
    //
    public function getidislas()
    {
        return $this->hasOne(Islas::className(), ['idislas' => 'idislas']);
    }

    /**
     * Gets query for [[Idpropietario0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirPropietario()
    {
        //return $this->hasOne(Propietario::className(), ['idpropietario' => 'idpropietario']);
        $propietario = Propietario::find()->where(['idpropietario'=>$this->idpropietario])->one();
        return $propietario;
    }
    //
    public function getidpropietario()
    {
        return $this->hasOne(Propietario::className(), ['idpropietario' => 'idpropietario']);
    }
}
