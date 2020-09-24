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
 * @property int $statusvacunado
 * @property int $statusdesparacitado
 * @property int $statusdiscapacidad
 * @property int $statustratamiento
 * @property int $statusesterilizado
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
            [['idprocedencia', 'nombre', 'sexo', 'edad', 'statusvacunado', 'statusdesparacitado', 'statusdiscapacidad', 'statustratamiento', 'statusesterilizado'], 'required','message'=>"!Este campo no puede estar vacio¡"],
            [['idespecies', 'idprocedencia', 'idpropietario', 'sexo', 'statusvacunado', 'statusdesparacitado', 'statusdiscapacidad', 'statustratamiento', 'statusesterilizado'], 'default', 'value' => null],
            [['idespecies', 'idprocedencia', 'idpropietario', 'sexo', 'statusvacunado', 'statusdesparacitado', 'statusdiscapacidad', 'statustratamiento', 'statusesterilizado'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre', 'edad'], 'string', 'max' => 255],
            [['created_by', 'updated_by'], 'string', 'max' => 128],
            [['idespecies'], 'exist', 'skipOnError' => true, 'targetClass' => Especies::className(), 'targetAttribute' => ['idespecies' => 'idespecies']],
            [['sexo'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus::className(), 'targetAttribute' => ['sexo' => 'idestatus']],
            [['statusvacunado'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus::className(), 'targetAttribute' => ['statusvacunado' => 'idestatus']],
            [['statusdesparacitado'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus::className(), 'targetAttribute' => ['statusdesparacitado' => 'idestatus']],
            [['statusdiscapacidad'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus::className(), 'targetAttribute' => ['statusdiscapacidad' => 'idestatus']],
            [['statustratamiento'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus::className(), 'targetAttribute' => ['statustratamiento' => 'idestatus']],
            [['statusesterilizado'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus::className(), 'targetAttribute' => ['statusesterilizado' => 'idestatus']],
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
            'statusvacunado' => 'Esta Vacunado',
            'statusdesparacitado' => 'Esta Desparacitado',
            'statusdiscapacidad' => 'Tiene Discapacidad',
            'statustratamiento' => 'Tiene Tratamiento',
            'statusesterilizado' => 'Esta Esterilizado',
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
    public function registrar($idespecies,$idpropietario){
        $mascota = new Mascota;
        $mascota->idespecies = $idespecies;
        $mascota->idprocedencia = $this->idprocedencia;
        $mascota->idpropietario = $idpropietario;
        $mascota->nombre = $this->nombre;
        $mascota->sexo = $this->sexo;
        $mascota->edad = $this->edad;
        $mascota->statusvacunado = $this->statusvacunado;
        $mascota->statusdesparacitado = $this->statusdesparacitado;
        $mascota->statusdiscapacidad = $this->statusdiscapacidad;
        $mascota->statustratamiento = $this->statustratamiento;
        $mascota->statusesterilizado = $this->statusesterilizado;
        $mascota->created_by = !Yii::$app->user->isGuest ? Yii::$app->user->identity->username : 'userinvitado';
        $mascota->created_at = date('Y-m-d h:i:s',time());

        if ( $mascota->save() ) {
            return $mascota;
        }else {
            return false;
        }
    }

    /**
    *   metodo para actualizar una MASCOTA
    *   @return boolean
    *   @method actualizar
    */
    public function actualizar($propietario = null){
        $mascota = Mascota::find()->where(['idmascota'=>$this->idmascota])->one();
        //$mascota->idespecies = $this->idespecies;
        $mascota->idprocedencia = $this->idprocedencia;
        $mascota->idpropietario = $propietario->idpropietario;
        $mascota->nombre = $this->nombre;
        $mascota->sexo = $this->sexo;
        $mascota->edad = $this->edad;
        $mascota->statusvacunado = $this->statusvacunado;
        $mascota->statusdesparacitado = $this->statusdesparacitado;
        $mascota->statusdiscapacidad = $this->statusdiscapacidad;
        $mascota->statustratamiento = $this->statustratamiento;
        $mascota->statusesterilizado = $this->statusesterilizado;
        $mascota->updated_by = !Yii::$app->user->isGuest ? Yii::$app->user->identity->username : 'userinvitado';
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
        $especies = Especies::find()->where(['idespecies' => $this->idespecies])->one();
        return $especies;
    }
    //
    public function gettipomascota()
    {
        return $this->hasOne(Especies::className(), ['idespecies' => 'idespecies']);
    }

    /**
     * Gets query for [[Sexo0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascSexo()
    {
        $estatus = Estatus::find()->where(['idestatus'=>$this->sexo])->one();
        return $estatus;
    }
    //
    public function getsexo()
    {
        return $this->hasOne(Estatus::className(), ['idestatus' => 'sexo']);
    }

    /**
     * Gets query for [[VacunaAntirab]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascEstaVacunado()
    {
        $estatus = Estatus::find()->where(['idestatus'=>$this->statusvacunado])->one();
        return $estatus;
    }
    //
    public function getestavacunado()
    {
        return $this->hasOne(Estatus::className(), ['idestatus' => 'statusvacunado']);
    }

    /**
     * Gets query for [[Desparacitado0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascEstaDesparacitado()
    {
        $estatus = Estatus::find()->where(['idestatus'=>$this->statusdesparacitado])->one();
        return $estatus;
    }
    //
    public function getestadesparacitado()
    {
        return $this->hasOne(Estatus::className(), ['idestatus' => 'statusdesparacitado']);
    }

    /**
     * Gets query for [[Discapacidad0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascTieneDiscapacidad()
    {
        $estatus = Estatus::find()->where(['idestatus'=>$this->statusdiscapacidad])->one();
        return $estatus;
    }
    //
    public function gettienediscapacidad()
    {
        return $this->hasOne(Estatus::className(), ['idestatus' => 'statusdiscapacidad']);
    }

    /**
     * Gets query for [[Discapacidads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascDiscapacidad()
    {
        $discapacidad = Discapacidad::find()->where(['idmascota'=>$this->idmascota])->one();
        return $discapacidad;
    }
    //
    public function getnombdiscapacidad()
    {
        return $this->hasMany(Discapacidad::className(), ['idmascota' => 'idmascota']);
    }

    /**
     * Gets query for [[Tratamiento0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascTieneTratamiento()
    {
        $estatus = Estatus::find()->where(['idestatus'=>$this->statustratamiento])->one();
        return $estatus;
    }
    //
    public function gettienetratamiento()
    {
        return $this->hasOne(Estatus::className(), ['idestatus' => 'statustratamiento']);
    }

    /**
     * Gets query for [[Tratamientos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascTratamiento()
    {
        $tratamiento = Tratamiento::find()->where(['idmascota'=>$this->idmascota])->one();
        return $tratamiento;
    }
    //
    public function getnombtratamiento()
    {
        return $this->hasMany(Tratamiento::className(), ['idmascota' => 'idmascota']);
    }

    /**
     * Gets query for [[Esterelizado0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascEstaEsterelizado()
    {
        $estatus = Estatus::find()->where(['idestatus'=>$this->statusesterilizado])->one();
        return $estatus;
    }
    //
    public function getesterelizado()
    {
        return $this->hasOne(Estatus::className(), ['idestatus' => 'statusesterilizado']);
    }

    /**
     * Gets query for [[Idprocedencia0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascProcedencia()
    {
        $procedencia = Procedencia::find()->where(['idprocedencia'=>$this->idprocedencia])->one();
        return $procedencia;
    }
    //
    public function getidprocedencia()
    {
        return $this->hasOne(Procedencia::className(), ['idprocedencia' => 'idprocedencia']);
    }

    /**
     * Gets query for [[Idpropietario0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascPropietario()
    {
        $propietario = Propietario::find()->where(['idpropietario'=>$this->idpropietario])->one();
        return $propietario;
    }
    //
    public function getidpropietario()
    {
        return $this->hasOne(Propietario::className(), ['idpropietario' => 'idpropietario']);
    }

}
