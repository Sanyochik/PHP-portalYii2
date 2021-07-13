<div class="class">
<?php 
use \yii\widgets\ActiveForm;
use app\models\Temi;
		$name = (Temi::find()
		->where("id = ".$_SESSION['spis'])
		->one()
		->name);
		$text = (Temi::find()
		->where("id = ".$_SESSION['spis'])
		->one()
		->text);
		$stati = (Temi::find()
		->where("id = ".$_SESSION['spis'])
		->one()
		->stati);
		if($stati==0){
			$staty='false';
		}
		if(stati==1){
			$staty='true';
		}

 ?>
<h1 class="reg">Изменение темы</h1><br>
<?php
	$form = ActiveForm::begin(['class'=>'form-horizontal']);  
?>
<p>Ведите новое название темы:</p>
<?= $form->field($model, 'name')->textInput(['autofocus'=>true,'value'=>$name, 'maxlength' => 255, 'class' => 'class2'])?>
<p>Введите новое описание темы:</p>
<?= $form->field($model, 'text')->textarea(['value'=>$text,'maxlength' => 255, 'class' => 'class10'])?>
<?		if($stati==0){
			echo $form->field($model, 'stati')->checkbox([ 'value' => '1', 'aria-invalid' => false])->label('Сделать тему закрытой:');
}?>
<?		if($stati==1){
			echo $form->field($model, 'stati')->checkbox([ 'value' => '1', 'checked' => true])->label('Сделать тему закрытой:');
}?>

<div>
	<button type="submit" class="btn btn-success">Внести изменения</button>
</div>

<?php
	ActiveForm::end();

 ?>
 </div>