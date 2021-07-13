<?php

namespace app\models;

use yii\base\Model;
use Yii;


class Signup extends Model
{
	public $username;
	public $password;

	public function rules()
	{
		return [

			[['username','password'],'required', 'message' =>'Обязательно к заполнению'],
			['username','unique','targetClass'=>'app\models\User', 'message' => 'Этот Логин уже используется'],
			['password','string','max'=>55, 'message' => 'Слишком длинное название'],
			['username','string','max'=>10, 'message' => 'Слишком длинное название']

		];
	}
	public function attributeLabels()
  {
    return [
      'username' => 'Введите логин',
      'password' => 'Введите пароль',
        ];
  }

	public function signup()
	{
		$user = new User();
		$user->username = $this->username;
		$user->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
		return $user->save();

	}
	
}