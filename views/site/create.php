<div class="class">
<?php 
use \yii\widgets\ActiveForm;
 ?>
<h1 class="reg">Создание новой темы</h1><br>
<?php
	$form = ActiveForm::begin(['class'=>'form-horizontal']);  
?>
<p>Ведите название темы:</p><br>
<?= $form->field($model, 'name')->textInput(['autofocus'=>true, 'maxlength' => 255, 'class' => 'class2'])?>
<p>Описание темы:</p><br>
<?= $form->field($model, 'text')->textarea(['maxlength' => 255, 'class' => 'class10'])?>
<?= $form->field($model, 'stati')->checkbox([ 'value' => '1', 'checked ' => false])->label('Сделать тему закрытой:');?>

<div>
	<button type="submit" class="btn btn-success">Создать новую тему</button>
</div>

<?php
	ActiveForm::end();

 ?>
 </div>