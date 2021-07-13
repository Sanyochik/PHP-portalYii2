<div class="class">
<?php 
use \yii\widgets\ActiveForm;
 ?>
<h1 class="reg">Регистрация</h1>
<br>
<?php
	$form = ActiveForm::begin(['class'=>'form-horizontal']);  
?>

<?= $form->field($model, 'username')->textInput(['autofocus'=>true, 'maxlength' => 255, 'class' => 'class1'])?>
<br>

<?= $form->field($model, 'password')->passwordInput(['maxlength' => 255, 'class' => 'class2'])?>
<br>
<div>
	<button type="submit" class="btn btn-success">Зарегистрироваться</button>
</div>

<?php
	ActiveForm::end();

 ?>
 </div>