<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
	
	
	class Group extends ActiveRecord{
	public static function tableName(){ 	
		return 'group';
	}	
}	
?>