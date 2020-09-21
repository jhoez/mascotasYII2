<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model{
	public $username;
	public $password;

	public function rules(){
		return [
			[['username','password'],'required','message'=>'Campo requerido']
		];
	}

	/**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username'=>'Usuario',
            'password'=>'Contraseña',
        ];
    }
}
?>
