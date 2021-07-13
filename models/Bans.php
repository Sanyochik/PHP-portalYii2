<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
	
	
	class Bans extends ActiveRecord{
	public static function tableName(){ 	
		return 'bans';
	}	
}	
?>