<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "propietario".
 *
 * @property int $idpropietario
 * @property string $nombres
 * @property string $apellidos
 * @property int $cedula
 * @property bool $estatus
 * @property string $telefono
 * @property string $nacionalidad
 * @property string $correo
 * @property int|null $id_persona_carnet
 *
 * @property Direccion[] $direccions
 * @property Mascota[] $mascotas
 * @property CarnetPersona $personaCarnet
 */
class Propietario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'regmasc.propietario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombres', 'apellidos', 'cedula', 'telefono', 'nacionalidad', 'correo'], 'required'],
            [['cedula', 'id_persona_carnet'], 'default', 'value' => null],
            [['cedula', 'id_persona_carnet'], 'integer'],
            [['nombres', 'apellidos', 'correo'], 'string', 'max' => 255],
            [['telefono'], 'string', 'max' => 45],
            [['nacionalidad'], 'string', 'max' => 1],
            [['id_persona_carnet'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['id_persona_carnet' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idpropietario' => 'Idpropietario',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'cedula' => 'Cedula',
            'estatus' => 'Estatus',
            'telefono' => 'Telefono',
            'nacionalidad' => 'Nacionalidad',
            'correo' => 'Correo',
            'id_persona_carnet' => 'Id Persona Carnet',
        ];
    }

    /**
    *   metodo para registrar DATOS del PROPIETARIO
    *   @return model
    *   @method registrar
    */
    public function registrar ()
    {
        $propietario = new Propietario;
        $propietario->nombres = $this->nombres;
        $propietario->apellidos = $this->apellidos;
        $propietario->cedula = $this->cedula;
        $propietario->telefono = $this->telefono;
        $propietario->nacionalidad = $this->nacionalidad;
        $propietario->correo = $this->correo;

        if ( $propietario->save() ) {
            return $propietario;
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
        return $this->hasMany(Direccion::className(), ['idpropietario' => 'idpropietario']);
    }

    /**
     * Gets query for [[Mascotas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascotas()
    {
        return $this->hasMany(Mascota::className(), ['idpropietario' => 'idpropietario']);
    }

    /**
     * Gets query for [[PersonaCarnet]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaCarnet()
    {
        return $this->hasOne(CarnetPersona::className(), ['id' => 'id_persona_carnet']);
    }
}
