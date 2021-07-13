<?php

namespace app\models;

use yii\base\Model;

class Login extends Model
{
    public $username;
    public $password;

    public function rules()
    {
        return [
            [['username','password'],'required', 'message' => 'Обязательно к заполнению'],
            ['password','validatePassword']
        ];
    }
	public function attributeLabels()
  {
    return [
      'username' => 'Введите логин',
      'password' => 'Введите пароль',
        ];
  }

    public function validatePassword($attribute,$params)
    {
        if(!$this->hasErrors())
        {
            $user = $this->getUser();

        if(!$user || !$user->validatePassword($this->password))
            {
            $this->addError($attribute,'Логин или пароль введены неверно');
            }
        }

        
    }

    public function getUser()
    {
        return User::findOne(['username'=>$this->username]);
    }
}
