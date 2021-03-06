<?php

namespace backend\models;

use Yii;
use backend\models\Estatus;

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
        return 'especies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idtipo', 'raza', 'color'], 'required'],
            [['idtipo'], 'default', 'value' => null],
            [['idtipo'], 'integer'],
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
     * Gets query for [[Idtipo0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdtipo0()
    {
        //return $this->hasOne(Estatus::className(), ['idestatus' => 'idtipo']);
        $estatus=Estatus::find()->where(['idestatus',$this->idtipo])->one();
        return $estatus;
    }

    /**
     * Gets query for [[Mascotas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMascotas()
    {
        return $this->hasMany(Mascota::className(), ['idespecies' => 'idespecies']);
    }
}
