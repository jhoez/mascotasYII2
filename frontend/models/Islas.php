<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "islas".
 *
 * @property int $idislas
 * @property string|null $nombre
 *
 * @property Direccion[] $direccions
 */
class Islas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'regmasc.islas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'],'required'],
            [['nombre'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idislas' => 'Idislas',
            'nombre' => 'Nombre',
        ];
    }

    /**
    *   metodo para registrar una isla
    *   @return boolean
    *   @method registrar
    */
    public function registrar()
    {
        //echo "<pre>";var_dump($islas);die;
        $islas = new Islas;
        $islas->nombre = $this->nombre;
        if ($islas->save()) {
            return $islas;
        }else {
            return false;
        }
    }

    /**
     * Gets query for [[Direccions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDireccions()
    {
        return $this->hasMany(Direccion::className(), ['idislas' => 'idislas']);
    }
}
