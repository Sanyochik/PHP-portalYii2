<?php

namespace app\models;
use yii;
use yii\base\Model;


class Creats extends Model
{
	public $txt;


	public function rules()
	{
		return [

			[['txt'],'required', 'message' =>'Обязательно к заполнению'],

		];
	}
	public function attributeLabels()
  {
    return [
      'txt' => '',
        ];
  }

	public function creats()
	{
		$com = new Com();;
		$com->id_temi = $_SESSION['now'];
		$com->daty = date("Y-m-d H.i.s");
		$com->id_coment = $_SESSION['otv'];
		$com->texty = $this->txt;
		$com->id_user = Yii::$app->user->id;
		return $com->save();

	}
	
}