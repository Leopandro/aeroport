<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "driver".
 *
 * @property integer $id
 * @property string $surname
 * @property string $name
 * @property string $middle_name
 * @property string $serial_number
 * @property integer $town_id
 * @property integer $car_id
 * @property integer $phone_number
 * @property integer $phone_number_2
 * @property string $email
 * @property string $comment
 *
 * @property Car $car
 * @property Town $town
 */
class Driver extends \yii\db\ActiveRecord
{
	public $cars;
	public $tariffs;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'driver';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['town_id', 'car_id', 'phone_number', 'experience'], 'integer'],
	        [['name'], 'required'],
	        [['phone_number'], 'match', 'pattern' => '/^([+]?)(7|8|9)\d{9,11}$/i'],
            [['surname', 'name', 'middle_name', 'email'], 'string', 'max' => 64],
	        [['serial_number'], 'string', 'max' => 50],
            [['comment'], 'string', 'max' => 640],
            [['car_id'], 'exist', 'skipOnError' => true, 'targetClass' => Car::className(), 'targetAttribute' => ['car_id' => 'id']],
            [['town_id'], 'exist', 'skipOnError' => true, 'targetClass' => Town::className(), 'targetAttribute' => ['town_id' => 'id']],
//	        [['email'], 'email']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
	    return [
		    'id' => Yii::t('app', 'ID'),
		    'surname' => Yii::t('app/person', 'Surname'),
		    'name' => Yii::t('app/person', 'Name'),
		    'middle_name' => Yii::t('app/person', 'Middle Name'),
		    'town_id' => Yii::t('app', 'Town'),
		    'car_id' => Yii::t('app', 'Car'),
		    'phone_number' => Yii::t('app', 'Phone'),
		    'phone_number_2' => Yii::t('app', 'Phone'),
		    'email' => Yii::t('app', 'Email'),
		    'comment' => Yii::t('app', 'Comment'),
		    'experience' => Yii::t('app', 'Опыт работы'),
	    ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCar()
    {
        return $this->hasOne(Car::className(), ['id' => 'car_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTown()
    {
        return $this->hasOne(Town::className(), ['id' => 'town_id']);
    }

//	public function getCars()
//	{
//		return $this->hasMany(DriverCar::className(), ['driver_id' => 'id']);
//	}

	public static function getDriversForDropdownList()
	{
		$result = (new Query())
			->select('*')
			->from(Driver::tableName())
			->all();
		return ArrayHelper::map($result, 'id', 'name');
	}

	public function loadCars()
	{
		$result = (new Query())
			->select('id')
			->from(DriverCar::tableName())
			->where(['driver_id' => $this->id])
			->all();
		$arr[0] = new DriverCar();
		foreach ($result as $item)
		{
			$arr[$item['id']] = DriverCar::findOne(['id' => $item['id']]);
		}
		$this->cars = $arr;
	}

	public function saveCars($rows = [])
	{
		$query = DriverCar::deleteAll(['driver_id' => $this->id]);
		if (!empty($rows))
			foreach($rows as $item)
			{
				$model = new DriverCar(['driver_id' => $this->id]);
				$model->scenario = 'save';
				$model->car_id = $item['car_id'];
				if ($model->validate())
					$model->save();
			}
	}

	public function getDriverCars($id)
	{
		$arr = [];
		$result = (new Query())
			->select('car.*')
			->from('car')
			->leftJoin('driver_car', '`driver_car`.`car_id` = `car`.`id`')
			->where(['driver_car.driver_id' => $this->id])
			->all();
		if (is_array($result))
		{
			foreach($result as $item)
			{
				$arr[$item['id']] = Car::getCarBrandById($item['company']).' '.$item['model'].' '.$item['number'];
			}
			return $arr;
		}
		else
		{
			return $arr;
		}
	}

	public function loadTariffs()
	{
		$model = DriverTariff::findOne(['id' => $this->id]);
		if (!$model)
		{
			$model = new DriverTariff(['id' => $this->id]);
		}
		$this->tariffs = $model;
	}
}
