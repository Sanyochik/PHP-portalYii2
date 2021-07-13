<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class TestForm extends ActiveRecord{
	
	public static function tableName(){
		return 'message';
	}
	
	public function attributeLabels(){
		return [
			'name'=>'Имя',
			'email'=>'Электронная почта',
			'text'=>'Текст сообщения',
		];
	}
	
	public function rules(){
		return [
			[['name','email'],'required','message'=>'Обязательное поле'],
			['name', 'string', 'max'=>20, 'tooLong'=>'Слишком большое Имя'],
			['email', 'string', 'max'=>50, 'tooLong'=>'Слишком большой E-mail'],
			//['name', 'myRule'],
			['text','trim'],
		];
	}
	
	/*public function myRule($attr){
		if(in_array($this->$attr,['name','first name'])){
			$this->addError($attr,'Ошибка');
		}
	}*/
	
}