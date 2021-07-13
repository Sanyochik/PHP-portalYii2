<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

use app\assets\AppAsset;
use app\models\Users;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <link rel="icon" type="image/png" href="/web/img/logodp.png">
    <link rel="shortcut icon" type="image/png" href="/web/img/logodp.png">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title>MyForum</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<body>
 
 <!-- start header -->
 
 <div class="header_bg">
 
 <div class="wrap">
 <div id="content">
 <header id="topnav">
 <nav>
 <ul>
     <?php
    NavBar::begin([
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'uMenuRoot',
        ],
    ]);
		    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
	            Yii::$app->user->isGuest ? (
                ['label' => 'Авторизация', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'botn btn-successs']
                )
                . Html::endForm()
                . '</li>'
		)
		],
		]);
		if(!Yii::$app->user->isGuest)
       {
			echo Nav::widget([
			'options' => ['class' => 'navbar-nav navbar-right'],
			'items' => [
            ['label' => 'Личный кабинет', 'url' => ['/site/profile']],
			],
			]);
	   }
	   		if(!Yii::$app->user->isGuest)
       {
		   		$adm = (Users::find()
					->where("id = ".Yii::$app->user->id)
					->one()
					->previl);
				if($adm == 1){
			echo Nav::widget([
			'options' => ['class' => 'navbar-nav navbar-right'],
			'items' => [
            ['label' => 'Админ-панель', 'url' => ['/site/admin']],
			],
			]);
				}
	   }
	   		if(Yii::$app->user->isGuest)
       {
			echo Nav::widget([
			'options' => ['class' => 'navbar-nav navbar-right'],
			'items' => [
			['label' => 'Регистрация', 'url' => ['/site/register']],
			],
			]);
	   }
	    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
			['label' => 'Главная страница', 'url' => ['/site/index']],
            ['label' => 'Проверка кода', 'url' => ['/site/code']],
			
        ],
    ]);
    NavBar::end();
    ?>

 <div id="uMenuDiv1"  style="position:relative;"><ul class="uMenuRoot">

 </ul>
 </nav>

 <div class="logo"><a><img height="50" src="../img/logop.png"></a></div>
 
 <a id="navbtn">Nav Menu</a>
 <div class="clear"> </div>
 </header><!-- @end #topnav -->
 </div>
 </div>
 </div>
   </div>
 <!--------start-blog----------->
 
 <div class="banner">
 <h2>Форум</h2>
      </div>

 <div class="sidebar">

     <div class="container">

        <?= $content ?>

	</div>
	</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
