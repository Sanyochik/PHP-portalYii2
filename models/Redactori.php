<?php

namespace app\models;

use yii\base\Model;
use app\Models\users;
use Yii;


class Redactori extends Model
{
	public $username;

	public function rules()
	{
		return [

			[['username'],'required', 'message' =>'Обязательно к заполнению'],
			['username','unique','targetClass'=>'app\models\User', 'message' => 'Этот Логин уже используется'],
			['username','string','max'=>10, 'message' => 'Слишком длинное название']

		];
	}
	public function attributeLabels()
  {
    return [
      'username' => 'Введите логин',
        ];
  }

	public function signup()
	{
		$user = new User();
		$user = Users::findOne($_SESSION['rel']);
		$user->username = $this->username;
		return $user->save();

	}
	
}