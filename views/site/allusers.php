<?
use app\models\Temi;
use app\models\Users;
Temi::find()->all();
$res=Users::find()->all();
?>
<?php
echo'
<div class="profile">
 

 <table border="0" width="100%" bgcolor="#FFFFFF" cellspacing="1" cellpadding="0" class="gTable"><tbody><tr><td class="gTableTop" colspan="7"><div style="float:right" class="gTopCornerRight"></div><a class="catLink">Список зарегистрированных пользователей</a>
 </td></tr><tr><td width="8%" class="gTableSubTop">&nbsp;</td><td class="gTableSubTop">Никнейм</td><td width="20%" class="gTableSubTop" align="center">Статус</td><td width="20%" class="gTableSubTop" align="center">Управление превилягиями</td><td width="20%" class="gTableSubTop">Действия</td><td width="20%" class="gTableSubTop">Изменить никнейм</td><td width="40%" class="gTableSubTop">Изменить пароль</td></tr>';

 foreach ($res as $key) {
	 if($key->previl==0){
		 $statys='Повысить до администратора';
		 $prev='Пользователь';
		 
	 }else
	 {
		 $statys='Понизить до пользователя';
		 $prev='Администратор';
	 }
	  	 if($key->staty==0){
		 $stati='Заблокировать';
	 }else
	 {
		 $stati='Разблокировать';
	 }
		if($key->previl==0){
			$prak='Сделать администратором';
		}else{
			$prak='Сделать пользователем';
		}
		if($key->id != 4 or Yii::$app->user->id== 4){
	 echo '
	 <tr>
	<td class="forumIcoTd" align="center">
	</td>
	<td class="forumNameTd">
	
	
	<div class="forumDescr">'.$key->username.'</div>
	
	
	</td>
	<td class="forumThreadTd" align="center">'.$prev.'</td>';

	if($key->id != 4 && $key->id !=Yii::$app->user->id){
	echo '
	<td class="forumPostTd" align="center"><a href="updatau?id='.$key->id.'">'.$statys.'</td>
	<td class="forumLastPostTd">
	<a class="forumLastPostLink" href="delety?id='.$key->id.'">'.$stati.'</a>

	</td>';
	
	}else{
		echo '
	<td class="forumPostTd" align="center"></td>
		<td class="forumLastPostTd"></td>';
	}
	
	echo'

		<td class="forumLastPostTd">
	<a class="forumLastPostLink" href="?id='.$key->id.'">Изменить никнейм</a>

	</td>
		<td class="forumLastPostTd">
	<a class="forumLastPostLink" href="?pas='.$key->id.'">Создать новый пароль</a>

	</td>


	</tr>';
	}
 }


	
	echo '</tbody></table>

	</div>';
	?>