<?php
namespace app\models;

use Yii;
use dektrium\user\models\User as BaseUser;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * @property integer $role_id
**/

class User extends BaseUser
{
	const ROLE_ADMIN = 1;
	const LEGAL_ENTITY = 2;
	const ROLE_MANAGER = 3;
	const ROLE_ACCOUNTANT = 4;
	const ROLE_DISPATCHER = 5;
	const INDIVIDUAL = 6;
//	public $admin_id;
	public $info;

	public static function getAllUsersForDropDownListByRole($roleName) {

		$roleData = Role::findOne(["name"=>$roleName]);

		$data = [];
		if($roleData)
			$data = ArrayHelper::map(User::find()->where(["role_id"=>$roleData->id])->asArray()->all(),'id','username');

		return $data;
	}

	public static function getNameById($id) {
		$row = self::find()->andWhere('id = :userId', array('userId' => $id))->one();
		if($row)
			return $row->username;
		return '';
	}
	public function scenarios()
	{
		$scenarios = parent::scenarios();
		// add field to scenarios
		array_merge($scenarios['create'], ['role_id', 'admin_id']);
		array_merge($scenarios['update'], ['role_id', 'admin_id']);
		array_merge($scenarios['register'], ['role_id', 'admin_id']);
		return $scenarios;
	}

	public function rules()
	{
		$rules = parent::rules();
		// add some rules

		$rules['fieldRequired'] = [['role_id'], 'required'];
		$rules['fieldLength']   = [['role_id'], 'number'];

		return $rules;
	}

	public function attributeLabels()
	{
		$arr = [
			'email' => Yii::t('app', 'Email'),
			'role_id' => Yii::t('app', 'Role'),
			'admin_id' => Yii::t('app', 'Admin ID')
		];
		return array_merge(parent::attributeLabels(), $arr);
	}

	public static function getUserRolesDropdownlist()
	{
		$arr = [
			self::ROLE_MANAGER => Yii::t('app', 'Manager'),
//			self::ROLE_DISPATCHER => Yii::t('app', 'Dispatcher'),
			self::ROLE_ACCOUNTANT => Yii::t('app', 'Accountant'),
		];
		return $arr;
	}

	public static function getClientRolesDropdownlist()
	{
		$arr = [
			self::LEGAL_ENTITY => Yii::t('app', 'Legal entity'),
//			self::INDIVIDUAL => Yii::t('app', 'Individual')
		];
		return $arr;
	}

	public static function getMenuItemsByRoleUser($isAdmin,$isGuest) {

		if($isGuest)
			return [];

		if(Yii::$app->user->identity->role_id == User::ROLE_ADMIN) {
			return [
				['label' => Yii::t('app', 'Clients'), 'url' => ['/client/index']],
				['label' => 'Пользователи', 'url' => ['/user/admin/index']],
				['label' => 'Заказы', 'url' => ['/order/index']],
				[
					'label' => 'Настройки',
					'items' => [
						[
							'label' => 'Методы оплаты',
							'url' => '/payment/index'
						],
						[
							'label' => 'Способы доставки',
							'url' => '/delivery/index'
						]
					]
				],
				[
					'label' => 'Выйти (' . Yii::$app->user->identity->username . ')',
					'url' => ['/site/logout'],
					'linkOptions' => ['data-method' => 'post']
				],
			];

		} else if(Yii::$app->user->identity->role_id == User::ROLE_USER){
			return [
				['label' => Yii::t('app', 'Clients'), 'url' => ['/client/index']],
				['label' => 'Заказы', 'url' => ['/order/index']],
				[
					'label' => 'Выйти (' . Yii::$app->user->identity->username . ')',
					'url' => ['/site/logout'],
					'linkOptions' => ['data-method' => 'post']
				],
			];
		}
	}

	public function getRole()
	{
		return $this->hasOne(Role::className(), ['id' => 'role_id']);
	}

	public function getUser_info()
	{
		return $this->hasOne(UserInfo::className(), [
			'id' => 'id'
		]);
	}
}
