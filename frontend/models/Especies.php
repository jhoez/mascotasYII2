<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "especies".
 *
 * @property int $idespecies
 * @property int $idtipo
 * @property string $raza
 * @property string $color
 *
 * @property Estatus $idtipo0
 * @property Mascota[] $mascotas
 */
class Especies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'regmasc.especies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idtipo', 'raza', 'color'], 'required','message'=>"!Este campo no puede estar vacio¡"],
            [['idtipo'], 'default', 'value' => null],
            [['idespecies', 'idtipo'], 'integer'],
            [['raza', 'color'], 'string', 'max' => 255],
            [['idtipo'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus::className(), 'targetAttribute' => ['idtipo' => 'idestatus']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idespecies' => 'Idespecies',
            'idtipo' => 'Idtipo',
            'raza' => 'Raza',
            'color' => 'Color',
        ];
    }

    /**
    *   metodo para registrar DATOS de ESPECIES
    *   @return model | false
    *   @method registrar
    */
    public function registrar()
    {
        $especies = new Especies;
        $especies->idtipo = $this->idtipo;
        $especies->raza = $this->raza;
        $especies->color = $this->color;

        if ( $especies->save() ) {
            return $especies;
        }else {
            return false;
        }
    }

    /**
    *   metodo para actualizar DATOS de ESPECIES
    *   @return model | false
    *   @method actualizar
    */
    public function actualizar()
    {
        $especies = Especies::find()->where(['idespecies'=>$this->idespecies])->one();
        $especies->idtipo = $this->idtipo;
        $especies->raza = $this->raza;
        $especies->color = $this->color;

        if ( $especies->save() ) {
            return $especies;
        }else {
            return false;
        }
    }

    /**
     * Gets query for [[Idtipo0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEspTipo()
    {
        //return $this->hasOne(Estatus::className(), ['idestatus' => 'idtipo']);
        $estatus = Estatus::find()->where(['idestatus' => $this->idtipo])->one();
        return $estatus;
    }

    /**
     * Gets query for [[Mascotas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEspMascotas()
    {
        //return $this->hasMany(Mascota::className(), ['idespecies' => 'idespecies']);
        $mascota = Mascota::find()->where(['idespecies' => $this->idespecies])->one();
        return $mascota;
    }
}
