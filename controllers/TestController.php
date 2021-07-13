<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\TestForm;
use app\models\Message;
use app\models\Users;
use app\models\Group;

class TestController extends Controller{
	
	//public $layout = 'base';
	
	public function actionIndex(){
		//$param = null;
		//$param = TestForm::find()->asArray()->all();
		//$param = new TestForm();
		$param = TestForm::findOne(2);
		
		$param->name = 'test name';
		$param->save();
		
		
		return $this->render('index', compact('param'));
	}
	
	public function actionForm($id=null){
		$model = null;
		if($id>0){
			$model = TestForm::findOne($id);
			
		}else{
			$model = new TestForm();
		}
		if($model->load(Yii::$app->request->post())){
				if($model->validate()){
					$model->save();
					Yii::$app->session->setFlash('success',"Форма работает");
					//$model = new TestForm();
					
				}else{
					Yii::$app->session->setFlash('error',"Форма не работает");
				}
			}
			return $this->render('form', compact('model'));	
	}
	
	public function actionTest(){
		$u=new Users();
		$a=new Group();
		/*$u->username='Petrov';
		$u->password=' ';
		$u->id_group='1';
		$u->fio=' ';
		$u->country=' ';
		$u->phone='7893124 ';
		$u->data='2011-05-02';
		$u->photo=' ';
		$u->email=' ';
		$u->info=' ';
		
		$u->save();*/
		return $this->render('test',compact('res','grp')); 
			
		
	}
	public function actionTest1(){
		$u=new Users();
				return $this->render('test1',compact('res')); 
			
		
	}
	public function actionTest2(){
		$u=new Users();
				return $this->render('test2',compact('res')); 
			
		
	}
		
		}