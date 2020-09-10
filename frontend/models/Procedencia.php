<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "procedencia".
 *
 * @property int $idprocedencia
 * @property string $nombre
 * @property string $descripcion
 *
 * @property Mascota[] $mascotas
 */
class Procedencia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'regmasc.procedencia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre', 'descripcion'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idprocedencia' => 'Idprocedencia',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * Gets query for [[Mascotas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascotas()
    {
        return $this->hasMany(Mascota::className(), ['idprocedencia' => 'idprocedencia']);
    }
}
