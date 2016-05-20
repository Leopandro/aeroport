<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "point".
 *
 * @property integer $id
 * @property integer $town_id
 * @property string $address
 */
class Point extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'point';
    }

	public function getTown()
	{
		return $this->hasOne(Town::className(), ['id' => 'town_id']);
	}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address', 'town_id'], 'required'],
            [['town_id'], 'integer'],
            [['street'], 'string', 'max' => 64],
            [['home'], 'string', 'max' => 16],
	        [['street', 'home'], 'string'],
            [['address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'town_id' => Yii::t('app', 'Town'),
            'address' => Yii::t('app', 'Address'),
            'street' => Yii::t('app', 'Улица'),
            'home' => Yii::t('app', 'Дом'),
        ];
    }

	public static function getTownsForDropDownList()
	{
		$result = (new Query())
			->select('id, name')
			->from(Town::tableName())
			->all();
		$arr = ArrayHelper::map($result, 'id', 'name');
		return $arr;
	}

	public static function getTownById($id)
	{
		return self::getTownsForDropDownList()[$id];
	}

	public static function getAddressInfo($id)
	{
		$result = (new Query())
			->select('street, home')
			->from(Point::tableName())
			->where(['id' => $id])
			->one();
		$arr = [
			'street' => $result['street'],
			'home' => $result['home']
		];
		if (empty($result['street']) && empty($result['home']))
			return false;
		return $arr;
	}
}
