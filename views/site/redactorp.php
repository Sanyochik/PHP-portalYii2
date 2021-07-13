<div class="class">
<?php 
use \yii\widgets\ActiveForm;
use app\models\users;
		$name = (Users::find()
		->where("id = ".$id)
		->one()
		->username);
 ?>
<h1 class="reg">Изменение пароля пользователя <?= $name?></h1><br>
<?php
	$form = ActiveForm::begin(['class'=>'form-horizontal']);  
?>
<?= $form->field($model, 'password')->passwordInput(['autofocus'=>true, 'maxlength' => 255, 'class' => 'class2'])?>
<div>
	<button type="submit" class="btn btn-success">Внести изменения</button>
</div>

<?php
	ActiveForm::end();

 ?>
 </div>