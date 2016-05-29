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
 * @property string $image
 * @property integer $number_of_passengers
 */
class Car extends \yii\db\ActiveRecord
{

	public $file;
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
	        [['image'], 'file', 'extensions' => 'jpg, jpeg, png, gif'],
            [['company', 'class', 'year', 'number_of_passengers', 'baby_chair', 'conditioner', 'baggage_count'], 'integer'],
            [['company', 'class', 'year', 'number_of_passengers', 'color', 'number'], 'required'],
	        [['image'], 'required'],
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
            'image' => 'Фотография',
            'model' => Yii::t('app', 'Model'),
            'class' => Yii::t('app', 'Class'),
            'year' => Yii::t('app', 'Year'),
            'number' => Yii::t('app', 'Number'),
            'baby_chair' => 'Детское кресло',
            'conditioner' => 'Кондиционер',
            'baggage_count' => 'Мест для багажа',
            'color' => Yii::t('app', 'Color'),
            'number_of_passengers' => Yii::t('app', 'Number Of Passengers'),
        ];
    }

	public function getCarBrand()
	{
		return self::getCarBrandsForDropdownList()[$this->company];
	}

	public static function getCarBrandById($id)
	{
		return self::getCarBrandsForDropdownList()[$id];
	}

	public function upload()
	{
		$path = Yii::getAlias('@app/web/files/images/');
		if (!is_dir($path)) mkdir($path, 0777, true);
		$filename = Yii::$app->security->generateRandomString(9);
		$this->file->saveAs($path . $filename . '.' . $this->file->extension);
		$this->image = $filename . '.' . $this->file->extension;
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

	public function getConditioner()
	{
		if ($this->conditioner == 0)
			return 'Нет';
		else return 'Да';
	}

	public function getChair()
	{
		if ($this->baby_chair == 0)
			return 'Нет';
		else return 'Да';
	}

	public function getCarClass()
	{
		return (self::getClassesForDropdownlist()[$this->class]);
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
