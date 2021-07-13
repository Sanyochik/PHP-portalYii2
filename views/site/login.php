<div class="class">
<?php
use yii\widgets\ActiveForm;
?>
<h1 class="reg">Авторизация<h1>
<br>
<?php $form = ActiveForm::begin();?>

<?= $form->field($login_model,'username')->textInput(['maxlength' => 255, 'class' => 'class1'])?>
<br>

<?= $form->field($login_model,'password')->passwordInput(['maxlength' => 255, 'class' => 'class2'])?>
<br>
<div>
    <button class="btn btn-success" type="submit">Авторизироваться</button>
</div>



<?php $form = ActiveForm::end();?>
</div>