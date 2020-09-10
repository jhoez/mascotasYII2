<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "carnet.persona".
 *
 * @property int $id
 * @property string $nacionalidad
 * @property string $cedula
 * @property string $primer_nombre
 * @property string|null $segundo_nombre
 * @property string $primer_apellido
 * @property string|null $segundo_apellido
 * @property string $fecha_nacimiento
 * @property string $lugar_nacimiento
 * @property string|null $foto
 * @property string $created_at
 * @property string $updated_at
 * @property int $estado_civil_id
 * @property int $categoria_id
 * @property int $casa_id
 * @property int $usuario_id
 *
 * @property Propietario[] $propietarios
 */
class Persona extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carnet.persona';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nacionalidad', 'cedula', 'primer_nombre', 'primer_apellido', 'fecha_nacimiento', 'lugar_nacimiento', 'created_at', 'updated_at', 'estado_civil_id', 'categoria_id', 'casa_id', 'usuario_id'], 'required'],
            [['fecha_nacimiento', 'created_at', 'updated_at'], 'safe'],
            [['estado_civil_id', 'categoria_id', 'casa_id', 'usuario_id'], 'default', 'value' => null],
            [['estado_civil_id', 'categoria_id', 'casa_id', 'usuario_id'], 'integer'],
            [['nacionalidad'], 'string', 'max' => 1],
            [['cedula'], 'string', 'max' => 10],
            [['primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido'], 'string', 'max' => 20],
            [['lugar_nacimiento'], 'string', 'max' => 255],
            [['foto'], 'string', 'max' => 30],
            [['casa_id'], 'exist', 'skipOnError' => true, 'targetClass' => CarnetCasa::className(), 'targetAttribute' => ['casa_id' => 'id']],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => CarnetCategoria::className(), 'targetAttribute' => ['categoria_id' => 'id']],
            [['estado_civil_id'], 'exist', 'skipOnError' => true, 'targetClass' => CarnetEstadoCivil::className(), 'targetAttribute' => ['estado_civil_id' => 'id']],
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
            'nacionalidad' => 'Nacionalidad',
            'cedula' => 'Cedula',
            'primer_nombre' => 'Primer Nombre',
            'segundo_nombre' => 'Segundo Nombre',
            'primer_apellido' => 'Primer Apellido',
            'segundo_apellido' => 'Segundo Apellido',
            'fecha_nacimiento' => 'Fecha Nacimiento',
            'lugar_nacimiento' => 'Lugar Nacimiento',
            'foto' => 'Foto',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'estado_civil_id' => 'Estado Civil ID',
            'categoria_id' => 'Categoria ID',
            'casa_id' => 'Casa ID',
            'usuario_id' => 'Usuario ID',
        ];
    }

    /**
     * Gets query for [[Propietarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPropietarios()
    {
        return $this->hasMany(Propietario::className(), ['id_persona_carnet' => 'id']);
    }
}
