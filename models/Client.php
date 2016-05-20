<?php

namespace app\models;

use Yii;
use dektrium\user\models\User as BaseUser;
use yii\db\Query;
use yii\helpers\ArrayHelper;


class Client extends User
{
	public function rules()
	{
		$rules = parent::rules();
		// add some rules

		$rules[] = ['name', 'required'];
		$rules[] = ['name', 'string', 'max' => 255];

		return $rules;
	}


	public function getUser_info()
	{
		return $this->hasOne(UserInfo::className(), [
			'id' => 'id'
		]);
	}

	public static function getUserInfo($id)
	{
		$result = (new Query())
			->select('title, legal_name')
			->from(UserInfo::tableName())
			->where(['id' => $id])
			->one();
		return $result;
	}

	public static function getClientsForDropDownList()
	{
		$result = (new Query())
			->select('*')
			->from(UserInfo::tableName())
			->all();
		return ArrayHelper::map($result, 'id', 'title');
	}
}
