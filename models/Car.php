<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "car".
 *
 * @property integer $id
 * @property integer $company
 * @property string $model
 * @property integer $class
 * @property integer $year
 * @property string $number
 * @property string $color
 * @property integer $number_of_passengers
 */
class Car extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'car';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company', 'class', 'year', 'number_of_passengers'], 'integer'],
            [['model', 'number', 'color'], 'string', 'max' => 24],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'company' => Yii::t('app', 'Company'),
            'model' => Yii::t('app', 'Model'),
            'class' => Yii::t('app', 'Class'),
            'year' => Yii::t('app', 'Year'),
            'number' => Yii::t('app', 'Number'),
            'color' => Yii::t('app', 'Color'),
            'number_of_passengers' => Yii::t('app', 'Number Of Passengers'),
        ];
    }

	public static function getCarBrandById($id)
	{
		return self::getCarBrandsForDropdownList()[$id];
	}

	public static function getCarsForDropDownList()
	{
		$result = (new Query())
			->select('*')
			->from(Car::tableName())
			->all();
		$arr = [];
		foreach ($result as $item)
		{
			$name = self::getCarBrandById($item['company']).' '.$item['model'].' '.$item['number'];
			$arr[$item['id']] = $name;
		}
		return $arr;
	}

	public static function getCarBrandsForDropdownList()
	{
		$result = (new Query())
			->select('*')
			->from(CarBrand::tableName())
			->all();
		return ArrayHelper::map($result, 'id', 'name');
	}

	public static function getCarById($id)
	{
		return (self::getCarsForDropDownList()[$id]);
	}

	public static function getClassesForDropDownList()
	{
		return [
			1 => 'B',
			2 => 'C',
			3 => 'D',
			4 => 'E',
			5 => 'S',
			6 => 'M'
		];
	}

	public static function getClassById($id)
	{
		return (self::getClassesForDropdownlist()[$id]);
	}

	public function beforeSave($insert)
	{
		foreach ($this->attributes as $name => $value)
		{
			if (!$value)
				$this->attributes[$name] = NULL;
		}
		return parent::beforeSave($insert); // TODO: Change the autogenerated stub
	}
}
