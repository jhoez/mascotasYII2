<?php

namespace backend\models;

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
        return 'discapacidad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idmascota', 'nombre'], 'required'],
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
            'iddiscapacidad' => 'Iddiscapacidad',
            'idmascota' => 'Idmascota',
            'nombre' => 'Nombre',
        ];
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
