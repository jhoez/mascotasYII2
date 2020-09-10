<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "carnet.documento".
 *
 * @property int $id
 * @property string $nombre
 * @property string $archivo
 * @property string $created_at
 * @property int $persona_id
 * @property int $usuario_id
 */
class Documento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carnet.documento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'archivo', 'created_at', 'persona_id', 'usuario_id'], 'required'],
            [['created_at'], 'safe'],
            [['persona_id', 'usuario_id'], 'default', 'value' => null],
            [['persona_id', 'usuario_id'], 'integer'],
            [['nombre'], 'string', 'max' => 255],
            [['archivo'], 'string', 'max' => 50],
            [['persona_id'], 'exist', 'skipOnError' => true, 'targetClass' => CarnetPersona::className(), 'targetAttribute' => ['persona_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => CarnetUsuario::className(), 'targetAttribute' => ['usuario_id' => 'id']],
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
            'archivo' => 'Archivo',
            'created_at' => 'Created At',
            'persona_id' => 'Persona ID',
            'usuario_id' => 'Usuario ID',
        ];
    }
}
