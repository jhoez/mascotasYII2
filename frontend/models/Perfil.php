<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "carnet.perfil".
 *
 * @property int $id
 * @property string $nombre
 * @property string $alias
 */
class Perfil extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carnet.perfil';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'alias'], 'required'],
            [['nombre'], 'string', 'max' => 255],
            [['alias'], 'string', 'max' => 10],
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
            'alias' => 'Alias',
        ];
    }
}
