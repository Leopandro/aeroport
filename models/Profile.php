<?php
namespace app\models;

use dektrium\user\models\Profile as BaseProfile;
use Yii;
/**
 * This is the model class for table "Profile".
* @property string $days
 *
 */
class Profile extends BaseProfile
{
	public function rules()
	{
		return [
			'nameLength' => ['name', 'string', 'max' => 255],
			[['public_email'], 'email'],
			[['phone'], 'number'],
			[['public_email', 'phone'], 'safe']
		];
	}

	/** @inheritdoc */
	public function attributeLabels()
	{
		return [
			'name'           => Yii::t('user', 'ФИО'),
//			'public_email'           => Yii::t('app', 'Email'),
			'phone'          => Yii::t('user', 'Телефон'),
		];
	}

	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
			return true;
		}

		return false;
	}

	public static function haveAccess()
	{
		if (Yii::$app->user->identity->role_id == User::ROLE_ADMIN)
			return true;
		$profile = Profile::findOne(['user_id' => Yii::$app->user->identity->getId()]);
		if ($profile->apply == 0 || $profile->apply == NULL)
			return true;
		$days = json_decode($profile->days);
		$thisDay = date('N');
		if (!in_array($thisDay, $days))
			return false;
		$from = $profile->from;
		$to = $profile->to;
		$hour = intval(date('H'));
		if (!($from < $hour && $to > $hour))
			return false;
		return true;
	}
}
