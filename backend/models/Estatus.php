<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "estatus".
 *
 * @property int $idestatus
 * @property int|null $id_padre
 * @property string|null $nombre
 * @property int|null $cant_hijos
 *
 * @property Especies[] $especies
 * @property Mascota[] $mascotas
 * @property Mascota[] $mascotas0
 * @property Mascota[] $mascotas1
 * @property Mascota[] $mascotas2
 * @property Mascota[] $mascotas3
 * @property Mascota[] $mascotas4
 */
class Estatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estatus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_padre', 'cant_hijos'], 'default', 'value' => null],
            [['id_padre', 'cant_hijos'], 'integer'],
            [['nombre'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idestatus' => 'Idestatus',
            'id_padre' => 'Id Padre',
            'nombre' => 'Nombre',
            'cant_hijos' => 'Cant Hijos',
        ];
    }

    /**
     * Gets query for [[Especies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEspecies()
    {
        return $this->hasMany(Especies::className(), ['idtipo' => 'idestatus']);
    }

    /**
     * Gets query for [[Mascotas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascotas()
    {
        return $this->hasMany(Mascota::className(), ['sexo' => 'idestatus']);
    }

    /**
     * Gets query for [[Mascotas0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascotas0()
    {
        return $this->hasMany(Mascota::className(), ['vacuna_antirab' => 'idestatus']);
    }

    /**
     * Gets query for [[Mascotas1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascotas1()
    {
        return $this->hasMany(Mascota::className(), ['desparacitado' => 'idestatus']);
    }

    /**
     * Gets query for [[Mascotas2]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascotas2()
    {
        return $this->hasMany(Mascota::className(), ['discapacidad' => 'idestatus']);
    }

    /**
     * Gets query for [[Mascotas3]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascotas3()
    {
        return $this->hasMany(Mascota::className(), ['tratamiento' => 'idestatus']);
    }

    /**
     * Gets query for [[Mascotas4]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascotas4()
    {
        return $this->hasMany(Mascota::className(), ['esterelizado' => 'idestatus']);
    }
}
