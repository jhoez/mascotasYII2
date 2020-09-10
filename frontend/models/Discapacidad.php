<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "discapacidad".
 *
 * @property int $iddiscapacidad
 * @property int $idmascota
 * @property string $nombre
 *
 * @property Mascota $idmascota0
 */
class Discapacidad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'regmasc.discapacidad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['idmascota'], 'default', 'value' => null],
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
            'iddiscapacidad' => 'Id',
            'idmascota' => 'Mascota',
            'nombre' => 'Nombre',
        ];
    }

    /**
    *   metodo para registrar una discapacidad
    *   @return boolean || objeto
    *   @method registrar
    */
    public function registrar($idmascota)
    {
        $discapacidad = new Discapacidad;
        $discapacidad->idmascota = $idmascota;
        $discapacidad->nombre = $this->nombre;

        if ($discapacidad->save()) {
            return $discapacidad;
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
        return $this->hasOne(Mascota::className(), ['idmascota' => 'idmascota']);
    }
}
