<?
use app\models\Temi;
use app\models\Users;
$res=Temi::find()->all();
Users::find()->all();
?>
<?php
echo'
<div class="profile">
 

 
 <div class="gDivLeft"><div class="gDivRight"><table border="0" width="100%" bgcolor="#FFFFFF" cellspacing="1" cellpadding="0" class="gTable"><tbody><tr><td class="gTableTop" colspan="5"><div style="float:right" class="gTopCornerRight"></div><a class="catLink">Созданные темы</a>
 </td></tr><tr><td width="5%" class="gTableSubTop">&nbsp;</td><td class="gTableSubTop">Тема</td><td width="8%" class="gTableSubTop" align="center">Статус</td><td width="8%" class="gTableSubTop" align="center">Автор</td><td width="30%" class="gTableSubTop">Действия</td></tr>';

 foreach ($res as $key) {
	  	 if($key->stati==0){
		 $stati='Открытый';
	 }else
	 {
		 $stati='Закрытый';
	 }
	 $username = (Users::find()
		->where("id = ".$key->id_sozd)
		->one()
		->username);
		if(Yii::$app->user->isGuest && $key->stati==0)
       {
	 echo '
	 <tr>
	<td class="forumIcoTd" align="center">
	</td>
	<td class="forumNameTd">
	
	
	<div class="forumDescr"><a href="/site/index?id='.$key->id.'">'.$key->name.'</a></div>
	
	
	</td>
	<td class="forumThreadTd" align="center">'.$stati.'</td>
	<td class="forumPostTd" align="center">'.$username.'</td>
	<td class="forumLastPostTd">
	<a class="forumLastPostLink">'.$key->data.'</a>

	</td>

	</tr>';
	}
	if(!Yii::$app->user->isGuest){
	if($ban == 0){
	echo '
	 <tr>
	<td class="forumIcoTd" align="center">
	</td>
	<td class="forumNameTd">
	
	
	<div class="forumDescr"><a href="/site/index?id='.$key->id.'">'.$key->name.'</a></div>
	
	
	</td>
	<td class="forumThreadTd" align="center">'.$stati.'</td>
	<td class="forumPostTd" align="center">'.$username.'</td>
	<td class="forumLastPostTd">
	<a class="forumLastPostLink" href="?spis='.$key->id.'">Изменить тему</a>
	<a href="/site/del?id='.$key->id.'" class="krest"><img src="../img/krestikk.png"></a>

	</td>

	</tr>';
	}
	   }
 }

	
	echo '</tbody></table>
	</div>';
	?>