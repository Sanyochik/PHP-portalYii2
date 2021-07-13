<?php

namespace app\models;
use yii;
use yii\base\Model;


class Creaty extends Model
{
	public $text;


	public function rules()
	{
		return [

			[['text'],'required', 'message' =>'Обязательно к заполнению'],

		];
	}
	public function attributeLabels()
  {
    return [
      'text' => '',
        ];
  }

	public function creaty()
	{
		$com = new Com();;
		$com->id_temi = $_SESSION['now'];
		$com->daty = date("Y-m-d H.i.s");
		$com->id_coment = $_SESSION['otv'];
		$com->texty = $this->text;
		$com->id_user = Yii::$app->user->id;
		return $com->save();

	}

	
}