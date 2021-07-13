<?
use app\models\Temi;
use app\models\Users;
use app\models\Bans;
Temi::find()->all();
$res=Users::find()->all();
?>
<?php
$_SESSION['tem']=$redac[0]['id'];
echo'
<div class="profile">
 

 
 <div class="gDivLeft"><div class="gDivRight"><table border="0" width="100%" bgcolor="#FFFFFF" cellspacing="1" cellpadding="0" class="gTable"><tbody><tr><td class="gTableTop" colspan="5"><div style="float:right" class="gTopCornerRight"></div><a class="catLink">Список зарегистрированных пользователей</a>
 </td></tr><tr><td width="5%" class="gTableSubTop">&nbsp;</td><td class="gTableSubTop">Никнейм</td><td width="8%" class="gTableSubTop" align="center">Действия</td><td width="8%" class="gTableSubTop" align="center"></td><td width="30%" class="gTableSubTop"></td></tr>';

 foreach ($res as $key) {
	 $us = (Bans::find()
	->where(["id_user"=>$key->id, "id_temi"=>$_SESSION['tem']])
	->one()
	->staty);
	  	 if($us==0){
		 $stati='Заблокировать';
	 }else
	 {
		 $stati='Разблокировать';
	 }
		if($key->id != Yii::$app->user->id && $key->previl != 1 && $us==0){
	 echo '
	 <tr>
	<td class="forumIcoTd" align="center">
	</td>
	<td class="forumNameTd">
	
	
	<div class="forumDescr">'.$key->username.'</div>
	
	
	</td>

	<td class="forumThreadTd" align="center"><a class="forumLastPostLink" href="ban?id='.$key->id.'">Заблокировать</a></td>


	<td class="forumPostTd" align="center"></td>
	<td class="forumLastPostTd">
	

	</td>

	</tr>';
	}if($key->id != Yii::$app->user->id && $key->previl != 1 && $us==1){
	 echo '
	 <tr>
	<td class="forumIcoTd" align="center">
	</td>
	<td class="forumNameTd">
	
	
	<div class="forumDescr">'.$key->username.'</div>
	
	
	</td>

	<td class="forumThreadTd" align="center"><a class="forumLastPostLink" href="unban?id_user='.$key->id.'">Разблокировать</a></td>


	<td class="forumPostTd" align="center"></td>
	<td class="forumLastPostTd">
	

	</td>

	</tr>';
	
	}
 }

	
	echo '</tbody></table>

	</div>';
	?>