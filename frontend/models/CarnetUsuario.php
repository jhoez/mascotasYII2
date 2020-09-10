<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "carnet.usuario".
 *
 * @property int $id
 * @property string|null $cedula
 * @property string $nombre
 * @property string $apellido
 * @property string $login
 * @property string $clave
 * @property int $perfil_id
 */
class CarnetUsuario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carnet.usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido', 'login', 'clave', 'perfil_id'], 'required'],
            [['perfil_id'], 'default', 'value' => null],
            [['perfil_id'], 'integer'],
            [['cedula'], 'string', 'max' => 10],
            [['nombre', 'apellido'], 'string', 'max' => 20],
            [['login'], 'string', 'max' => 30],
            [['clave'], 'string', 'max' => 50],
            [['perfil_id'], 'exist', 'skipOnError' => true, 'targetClass' => CarnetPerfil::className(), 'targetAttribute' => ['perfil_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cedula' => 'Cedula',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'login' => 'Login',
            'clave' => 'Clave',
            'perfil_id' => 'Perfil ID',
        ];
    }
}
