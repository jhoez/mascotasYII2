<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tratamiento".
 *
 * @property int $idtratamiento
 * @property int $idmascota
 * @property string $nombre
 *
 * @property Mascota $idmascota0
 */
class Tratamiento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'regmasc.tratamiento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            //[['idmascota'], 'default', 'value' => null],
            [['idmascota'], 'integer'],
            [['nombre'], 'string', 'max' => 255],
            [['idmascota'], 'exist', 'skipOnError' => true, 'targetClass' => Mascota::className(), 'targetAttribute' => ['idmascota' => 'idmascota']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idtratamiento' => 'Id',
            'idmascota' => 'Mascota',
            'nombre' => 'Nombre',
        ];
    }

    /**
    *   metodo para registrar una tratamiento
    *   @return boolean || objeto
    *   @method registrar
    */
    public function registrar($idmascota)
    {
        $tratamiento = new Tratamiento;
        $tratamiento->idmascota = $idmascota;
        $tratamiento->nombre = $this->nombre;

        if ($tratamiento->save()) {
            return $tratamiento;
        }else {
            return false;
        }
    }

    /**
    *   metodo para actualizar una tratamiento
    *   @return boolean || objeto
    *   @method actualizar
    */
    public function actualizar()
    {
        $tratamiento = Tratamiento::find()->where(['idtratamiento'=>$this->idtratamiento])->one();
        $tratamiento->idmascota = $this->idmascota;
        $tratamiento->nombre = $this->nombre;

        if ($tratamiento->save()) {
            return $tratamiento;
        }else {
            return false;
        }
    }

    /**
     * Gets query for [[Idmascota0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdmascota0()
    {
        //return $this->hasOne(Mascota::className(), ['idmascota' => 'idmascota']);
        $tratamiento = Mascota::find()->where(['idmascota'=>$this->idmascota])->one();
        return $tratamiento;
    }
}
