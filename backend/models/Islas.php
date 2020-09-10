<?php

namespace backend\models;

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
        return 'islas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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
     * Gets query for [[Direccions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDireccions()
    {
        return $this->hasMany(Direccion::className(), ['idislas' => 'idislas']);
    }
}
