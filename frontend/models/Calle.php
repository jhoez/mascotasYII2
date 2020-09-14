<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "carnet.calle".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property Direccion[] $direccions
 */
class Calle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carnet.calle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * Gets query for [[Direccions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCaDireccion()
    {
        //return $this->hasMany(Direccion::className(), ['id_calle' => 'id']);
        $calle = Direccion::find()->where(['id_calle'=>$this->id])->one();
        return $calle;
    }
}
