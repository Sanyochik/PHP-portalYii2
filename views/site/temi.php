<?
use app\models\Temi;
use app\models\Users;
use app\models\Bans;
$res=Temi::find()->all();
Users::find()->all();
?>
<?php
 if(Yii::$app->user->isGuest){
 

 echo'
 <div class="profile">
 <div class="gDivLeft"><div class="gDivRight"><table border="0" width="100%" bgcolor="#FFFFFF" cellspacing="1" cellpadding="0" class="gTable"><tbody><tr><td class="gTableTop" colspan="5"><div style="float:right" class="gTopCornerRight"></div><a class="catLink">Созданные темы</a>';

 
 }
 if(!Yii::$app->user->isGuest){
		$ban = (Users::find()
		->where("id = ".Yii::$app->user->id)
		->one()
		->staty);
		if($ban == 0){
			echo'
<div class="profile">
<table border="0" width="100%" bgcolor="#FFFFFF" cellspacing="1" cellpadding="0" class="gTable"><tbody><tr><td class="gTableTop" colspan="5"><div style="float:right" class="gTopCornerRight"></div><a class="catLink">Созданные темы</a>
 <a class="ssilka" href="/site/create">Добавить новую запись</a>';
		}else{
	 echo'
	 <div class="profile">
	 <div class="gDivLeft"><div class="gDivRight"><table border="0" width="100%" bgcolor="#FFFFFF" cellspacing="1" cellpadding="0" class="gTable"><tbody><tr><td class="gTableTop" colspan="5"><div style="float:right" class="gTopCornerRight"></div><a class="catLink">Вам был заблокирован доступ на данный ресурс</a>';;
 }}
 if(!Yii::$app->user->isGuest){
	 if($ban == 0){
		echo'
 </td></tr><tr><td width="5%" class="gTableSubTop">&nbsp;</td><td class="gTableSubTop">Тема</td><td width="8%" class="gTableSubTop" align="center">Статус</td><td width="8%" class="gTableSubTop" align="center">Автор</td><td width="30%" class="gTableSubTop">дата создания</td></tr>';
	 }
 }
  if(Yii::$app->user->isGuest){
	  echo'
 </td></tr><tr><td width="5%" class="gTableSubTop">&nbsp;</td><td class="gTableSubTop">Тема</td><td width="8%" class="gTableSubTop" align="center">Статус</td><td width="8%" class="gTableSubTop" align="center">Автор</td><td width="30%" class="gTableSubTop">дата создания</td></tr>';
  }
 foreach ($res as $key) {
	 $j=$key->id;
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
	 if(!Yii::$app->user->isGuest){
	 	$bans = (Bans::find()
		->where(["id_user"=>Yii::$app->user->id, "id_temi"=>$key->id])
		->one()
		->staty);
	 }
		if(Yii::$app->user->isGuest && $key->stati==0)
       {
	 echo '
	 <tr>
	<td class="forumIcoTd" align="center">
	</td>
	<td class="forumNameTd">
	
	
	<div class="forumDescr"><a href="/site/index?id='.$j.'">'.$key->name.'</a></div>
	
	
	</td>
	<td class="forumThreadTd" align="center">'.$stati.'</td>
	<td class="forumPostTd" align="center">'.$username.'</td>
	<td class="forumLastPostTd">
	<a class="forumLastPostLink">'.$key->data.'</a>

	</td>

	</tr>';
	}

	if(!Yii::$app->user->isGuest){
	if($ban == 0 ){
		 if($bans==0){
	echo '
	 <tr>
	<td class="forumIcoTd" align="center">
	</td>
	<td class="forumNameTd">
	
	
	<div class="forumDescr"><a class="ssilochka" href="/site/index?id='.$j.'">'.$key->name.'</a></div>
	
	
	</td>
	<td class="forumThreadTd" align="center">'.$stati.'</td>
	<td class="forumPostTd" align="center">'.$username.'</td>
	<td class="forumLastPostTd">
	<a class="forumLastPostLink">'.$key->data.'</a>
		</td>

	</tr>';
	}
	   }
 }
}

	
	echo '</tbody></table>
	</div>';
	?>

