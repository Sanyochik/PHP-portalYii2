<?
use app\models\Temi;
use app\models\Users;
use app\models\Com;
use \yii\widgets\ActiveForm;
?>
<?
		$_SESSION['now']=$tema[0][id];
$resi=Com::find()->where("id_temi=".$_SESSION['now'])->all();
		$id = (Users::find()
		->where("id = ".$tema[0][id_sozd])
		->one()
		->username);

	
echo'<div class="zagolov"><p1 class="naz">'.$tema[0][name].'</p1></div>';
echo'<div class="classic">

	
	
	<div class="autor"><p class="avtor">'.$id.'';
	echo '</p></div>

	<div class="cont"><p class="conten">'.$tema[0][text].'</p></div>';
	echo '<div class="daty"><p class="datys">'.$tema[0][data].'</p></div>

	
	</div>';

?>
<div class="class">

<?php
if(!Yii::$app->user->isGuest ){
	if($_SESSION['otv']==0){
	$form = ActiveForm::begin(['class'=>'form-horizontal']);  
	}
}
?>

<?php 
if(!Yii::$app->user->isGuest ){
	if($_SESSION['otv']==0){
	echo"
	<p class='green'>Оставить коментарий:<br></p>
".$form->field($model, 'text')->textarea(['autofocus'=>true,'maxlength' => 255, 'class' => 'class10'])."";
	}}?>
<?php
if(!Yii::$app->user->isGuest ){
	if($_SESSION['otv']==0){
	echo'
<div>
	<button type="submit" class="btn btn-success">Оставить коментарий</button>
</div>';
}}
if($_SESSION['otv']!=0){
	echo'<div> <a href="/site/otvet?id=0" class="btn btn-success">Оставить коментарий</a></div>';
}
?>

<?php
if(!Yii::$app->user->isGuest ){
	if($_SESSION['otv']==0){
	ActiveForm::end();
}}
foreach ($resi as $key) {
	if($key->id_coment==0){
		$user = (Users::find()
		->where("id = ".$key->id_user)
		->one()
		->username);
			$sozdat = (Temi::find()
		->where("id = ".$tema[0][id])
		->one()
		->id_sozd);
	 echo '
	 <div class="classic">

	
	
	<div class="autor"><p class="avtor">'.$user.'';
	if($key->id_user==Yii::$app->user->id or $sozdat==Yii::$app->user->id){
	echo '<a href="/site/delete?del='.$key->id.'" class="kresty"><img width="30px" height="30px" src="../img/krestikk.png"></a>';
	}
	echo '</p></div>

	<div class="cont"><p class="conten">'.$key->texty.'</p></div>';
	if(!Yii::$app->user->isGuest){
		echo'
	<div class="otvetochka"><a class="otveti" href="otvet?id='.$key->id.'">Ответить</a></div>';
	}
	echo '<div class="daty"><p class="datys">'.$key->daty.'</p></div>

	
	</div>';
	if($_SESSION['otv']==$key->id){

	$form = ActiveForm::begin(['class'=>'form-horizontal']);  

 echo"".$form->field($model, 'text')->textArea(['autofocus'=>true, 'maxlength' => 255, 'class' => 'class10'])."";


 echo '<div>
	<button type="submit" class="btn btn-success">Оставить коментарий</button>
</div>';
	ActiveForm::end();

}
}
	$resy=Com::find()->where("id_coment=".$key->id)->all();
	foreach ($resy as $kay) {
	$user = (Users::find()
		->where("id = ".$kay->id_user)
		->one()
		->username);
	 echo '
	 <div class="classic2">

	

	<div class="autor"><p class="avtor">'.$user.'';
	if($kay->id_user==Yii::$app->user->id or $sozdat==Yii::$app->user->id){
	echo '<a href="/site/delete?del='.$kay->id.'" class="kresty"><img width="30px" height="30px" src="../img/krestiki.png"></a>';
	}
	echo '</p></div>
	<div class="cont"><p class="conten">'.$kay->texty.'</p></div>
	<div class="daty"><p class="datys">'.$kay->daty.'</p></div>

	
	</div>';
	if($_SESSION['otv']==$kay->id){

	$form = ActiveForm::begin(['class'=>'form-horizontal']);  

 echo"".$form->field($model, 'text')->textArea(['autofocus'=>true, 'maxlength' => 255, 'class' => 'class10'])."";


 echo '<div>
	<button type="submit" class="btn btn-success">Оставить коментарий</button>
</div>';
	ActiveForm::end();
}
}
}

 ?>
 </div>
