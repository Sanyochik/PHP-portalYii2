<?
use app\models\Temi;
use app\models\Users;
use app\models\Com;
$res=Temi::find()->all();
?>
<?
$username = (Users::find()
->where("id = ".Yii::$app->user->id)
->one()
->username);
$id = (Users::find()
->where("id = ".Yii::$app->user->id)
->one()
->id);
$statys = (Users::find()
->where("id = ".Yii::$app->user->id)
->one()
->previl);
if($statys==0){
	$previl="пользователь";
}else{
	$previl="администратор";
}
$yd = (temi::find()
->where("id_sozd = ".Yii::$app->user->id)
->one()
->id_sozd);
echo'<div class="zagolov"><h1 class="green">Добро пожаловать '.$previl.' '.$username.' в ваш личный кабинет</h1></div>';
if($yd == Yii::$app->user->id){
echo'
<div class="profile">

 

 
 <div class="gDivLeft"><div class="gDivRight"><table border="0" width="100%" bgcolor="#FFFFFF" cellspacing="1" cellpadding="0" class="gTable"><tbody><tr><td class="gTableTop" colspan="5"><div style="float:right" class="gTopCornerRight"></div><a class="catLink">Вы являетесь автором данных таких тем:</a>
 </td></tr><tr><td width="5%" class="gTableSubTop">&nbsp;</td><td class="gTableSubTop">Тема</td><td width="8%" class="gTableSubTop" align="center">Статус</td><td width="8%" class="gTableSubTop" align="center">Списки забаненых</td><td width="30%" class="gTableSubTop">Действия</td></tr>';
 foreach ($res as $key) {
	 if($key->id_sozd==Yii::$app->user->id){
	 if($key->stati==0){
		 $stati='Открытый';
	 }else
	 {
		 $stati='Закрытый';
	 }
	echo '
	 <tr>
	<td class="forumIcoTd" align="center">
	</td>
	<td class="forumNameTd">
	
	
	<div class="forumDescr"><a href="/site/index?id='.$key->id.'">'.$key->name.'</a></div>
	
	
	</td>
	<td class="forumThreadTd" align="center">'.$stati.'</td>
	<td class="forumPostTd" align="center"><a href="?id='.$key->id.'">Список пользователей</a></td>
	<td class="forumLastPostTd">
	<a class="forumLastPostLink" href="?spis='.$key->id.'">Изменить тему</a>
		<a href="/site/dely?id='.$key->id.'" class="krest"><img src="../img/krestikk.png"></a>
	</td>

	</tr>
	</div>';
	}
 }
}else{
	echo'<p class="green">На данный момент вы не создавали никаких тем </p>';
}
?>
