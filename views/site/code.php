<?php 
use \yii\widgets\ActiveForm;
 ?>
  <div class="text-center col-12">
    <br>
    <h2>Вставьте код</h2>
  </div>
	<div class="text-center col-20">
    <?php
     $form = ActiveForm::begin(['class'=>'form-horizontal']);  
    ?>
     <textarea rows="200" cols="200" class="class10" name="name" placeholder="Введите ваш код сюда" style="height: 335px;"><?php if(isset($_SESSION['codetest'])){
		    echo $_SESSION['codetest'];
				}else{
				echo "";};?></textarea>
      <div>
				<button type="submit" class="btn btn-success">Проверить</button>
      </div>
      <?php
        ActiveForm::end();
      ?> 
      <p>Результат:</p>
      <?php
        echo $_SESSION['codetest'];
        exec("php -l ../views/site/codetest.php", $output, $result);
        if ($result == 0){
           echo "{$str} Код прошёл проверку";
        } else {
           echo "{$str} Код не прошёл проверку";
           print_r ($output);
        };
      ?>
      </div>
<br>
