<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
  public function setPassword($password)
    {
        return $this -> password = sha1($password);
    }
    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password,$this->password);
    }

    public static function findIdentity($id)
    {
    	return self::findOne($id);
    }

    public function getId()
    {
    	return $this->id;
    }
    
    public static function findIdentityByAccessToken($token, $type = null)
    {
    	
    }  

    public function getAuthKey()
    {
    	
    }

    public function validateAuthKey($authkey)
    {
    	
    }

}