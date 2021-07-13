<?php

namespace app\models;
use yii;
use yii\base\Model;


class Create extends Model
{
	public $name;
	public $stati;
	public $text;


	public function rules()
	{
		return [

			[['name','stati','text'],'required', 'message' =>'Обязательно к заполнению'],
			['name','string','min'=>2,'max'=>20,],
			['stati','string','min'=>1,'max'=>1,],

		];
	}
	public function attributeLabels()
  {
    return [
      'name' => '',
      'stati' => '',
      'text' => '',
        ];
  }

	public function create()
	{
		$temi = new Temi();
		$id=Yii::$app->user->id;
		$data=date("Y-m-d H.i.s");
		$temi->name = $this->name;
		$temi->data = $data;
		$temi->stati = $this->stati;
		$temi->text = $this->text;
		$temi->id_sozd = $id;
		return $temi->save();

	}
	
}