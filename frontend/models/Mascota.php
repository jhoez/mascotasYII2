<?php

namespace frontend\models;

use Yii;
use frontend\models\Direccion;
use frontend\models\Discapacidad;
use frontend\models\Especies;
use frontend\models\Estatus;
use frontend\models\Islas;
use frontend\models\Procedencia;
use frontend\models\Propietario;
use frontend\models\Tratamiento;
use frontend\models\Calle;

/**
 * This is the model class for table "mascota".
 *
 * @property int $idmascota
 * @property int $idespecies
 * @property int $idprocedencia
 * @property int $idpropietario
 * @property string $nombre
 * @property int $sexo
 * @property string $edad
 * @property int $vacuna_antirab
 * @property int $desparacitado
 * @property int $discapacidad
 * @property int $tratamiento
 * @property int $esterelizado
 * @property string|null $created_by
 * @property string|null $created_at
 * @property string|null $updated_by
 * @property string|null $updated_at
 *
 * @property Discapacidad[] $discapacidads
 * @property Especies $idespecies0
 * @property Estatus $sexo0
 * @property Estatus $vacunaAntirab
 * @property Estatus $desparacitado0
 * @property Estatus $discapacidad0
 * @property Estatus $tratamiento0
 * @property Estatus $esterelizado0
 * @property Procedencia $idprocedencia0
 * @property Propietario $idpropietario0
 * @property Tratamiento[] $tratamientos
 */
class Mascota extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'regmasc.mascota';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idprocedencia', 'nombre', 'sexo', 'edad', 'vacuna_antirab', 'desparacitado', 'discapacidad', 'tratamiento', 'esterelizado'], 'required'],
            [['idespecies', 'idprocedencia', 'idpropietario', 'sexo', 'vacuna_antirab', 'desparacitado', 'discapacidad', 'tratamiento', 'esterelizado'], 'default', 'value' => null],
            [['idespecies', 'idprocedencia', 'idpropietario', 'sexo', 'vacuna_antirab', 'desparacitado', 'discapacidad', 'tratamiento', 'esterelizado'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre', 'edad'], 'string', 'max' => 255],
            [['created_by', 'updated_by'], 'string', 'max' => 128],
            [['idespecies'], 'exist', 'skipOnError' => true, 'targetClass' => Especies::className(), 'targetAttribute' => ['idespecies' => 'idespecies']],
            [['sexo'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus::className(), 'targetAttribute' => ['sexo' => 'idestatus']],
            [['vacuna_antirab'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus::className(), 'targetAttribute' => ['vacuna_antirab' => 'idestatus']],
            [['desparacitado'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus::className(), 'targetAttribute' => ['desparacitado' => 'idestatus']],
            [['discapacidad'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus::className(), 'targetAttribute' => ['discapacidad' => 'idestatus']],
            [['tratamiento'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus::className(), 'targetAttribute' => ['tratamiento' => 'idestatus']],
            [['esterelizado'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus::className(), 'targetAttribute' => ['esterelizado' => 'idestatus']],
            [['idprocedencia'], 'exist', 'skipOnError' => true, 'targetClass' => Procedencia::className(), 'targetAttribute' => ['idprocedencia' => 'idprocedencia']],
            [['idpropietario'], 'exist', 'skipOnError' => true, 'targetClass' => Propietario::className(), 'targetAttribute' => ['idpropietario' => 'idpropietario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idmascota' => 'Id',
            'idespecies' => 'Tipo de mascota',
            'idprocedencia' => 'Procedencia',
            'idpropietario' => 'Propietario',
            'nombre' => 'Nombre',
            'sexo' => 'Sexo',
            'edad' => 'Edad',
            'vacuna_antirab' => 'EstaVacunado',
            'desparacitado' => 'Esta Desparacitado',
            'discapacidad' => 'Discapacidad',
            'tratamiento' => 'Tratamiento',
            'esterelizado' => 'Esta Esterilizado',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
    *   metodo para registrar una Mascota
    *   @return boolean
    *   @method registrar
    */
    public function registrar($idtipo,$idpropietario){
        $mascota = new Mascota;
        $mascota->idespecies = (int)$idtipo;
        $mascota->idprocedencia = $this->idprocedencia;
        $mascota->idpropietario = $idpropietario;
        $mascota->nombre = $this->nombre;
        $mascota->sexo = $this->sexo;
        $mascota->edad = $this->edad;
        $mascota->vacuna_antirab = $this->vacuna_antirab;
        $mascota->desparacitado = $this->desparacitado;
        $mascota->discapacidad = $this->discapacidad;
        $mascota->tratamiento = $this->tratamiento;
        $mascota->esterelizado = $this->esterelizado;
        $mascota->created_by = isset(Yii::$app->user->identity->username) ? Yii::$app->user->identity->username : 'userinvitado';
        $mascota->created_at = date('Y-m-d h:i:s',time());
        $mascota->updated_by = isset(Yii::$app->user->identity->username) ? Yii::$app->user->identity->username : 'userinvitado';
        $mascota->updated_at = date('Y-m-d h:i:s',time());

        if ( $mascota->save() ) {
            return $mascota;
        }else {
            return false;
        }
    }

    /**
     * Gets query for [[Idespecies0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascTipoMascota()
    {
        //return $this->hasOne(Especies::className(), ['idespecies' => 'idespecies']);
        $especies = Especies::find()->where(['idespecies' => $this->idespecies])->one();
        return $especies;
    }

    /**
     * Gets query for [[Sexo0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascSexo()
    {
        //return $this->hasOne(Estatus::className(), ['idestatus' => 'sexo']);
        $estatus = Estatus::find()->where(['idestatus'=>$this->sexo])->one();
        return $estatus;
    }

    /**
     * Gets query for [[VacunaAntirab]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascEstaVacunado()
    {
        //return $this->hasOne(Estatus::className(), ['idestatus' => 'vacuna_antirab']);
        $estatus = Estatus::find()->where(['idestatus'=>$this->vacuna_antirab])->one();
        return $estatus;
    }

    /**
     * Gets query for [[Desparacitado0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascEstaDesparacitado()
    {
        //return $this->hasOne(Estatus::className(), ['idestatus' => 'desparacitado']);
        $estatus = Estatus::find()->where(['idestatus'=>$this->desparacitado])->one();
        return $estatus;
    }

    /**
     * Gets query for [[Discapacidad0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascTieneDiscapacidad()
    {
        //return $this->hasOne(Estatus::className(), ['idestatus' => 'discapacidad']);
        $estatus = Estatus::find()->where(['idestatus'=>$this->discapacidad])->one();
        return $estatus;
    }

    /**
     * Gets query for [[Discapacidads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascDiscapacidad()
    {
        //return $this->hasMany(Discapacidad::className(), ['idmascota' => 'idmascota']);
        $discapacidad = Discapacidad::find()->where(['idmascota'=>$this->idmascota])->one();
        return $discapacidad;
    }

    /**
     * Gets query for [[Tratamiento0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascTieneTratamiento()
    {
        //return $this->hasOne(Estatus::className(), ['idestatus' => 'tratamiento']);
        $estatus = Estatus::find()->where(['idestatus'=>$this->tratamiento])->one();
        return $estatus;
    }

    /**
     * Gets query for [[Tratamientos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascTratamiento()
    {
        //return $this->hasMany(Tratamiento::className(), ['idmascota' => 'idmascota']);
        $tratamiento = Tratamiento::find()->where(['idmascota'=>$this->idmascota])->one();
        return $tratamiento;
    }

    /**
     * Gets query for [[Esterelizado0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascEstaEsterelizado()
    {
        //return $this->hasOne(Estatus::className(), ['idestatus' => 'esterelizado']);
        $estatus = Estatus::find()->where(['idestatus'=>$this->esterelizado])->one();
        return $estatus;
    }

    /**
     * Gets query for [[Idprocedencia0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascProcedencia()
    {
        //return $this->hasOne(Procedencia::className(), ['idprocedencia' => 'idprocedencia']);
        $procedencia = Procedencia::find()->where(['idprocedencia'=>$this->idprocedencia])->one();
        return $procedencia;
    }

    /**
     * Gets query for [[Idpropietario0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascPropietario()
    {
        //return $this->hasOne(Propietario::className(), ['idpropietario' => 'idpropietario']);
        $propietario = Propietario::find()->where(['idpropietario'=>$this->idpropietario])->one();
        return $propietario;
    }

}
