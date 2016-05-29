<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "panel".
 *
 * @property integer $id
 * @property integer $car_id
 *
 * @property Car $car
 */
class Panel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'panel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
	        [['car_id', 'driver_id'], 'required'],
            [['car_id', 'driver_id', 'use_new_tariffs', 'town', 'town_center', 'km_price'], 'integer'],
            [['car_id'], 'exist', 'skipOnError' => true, 'targetClass' => Car::className(), 'targetAttribute' => ['car_id' => 'id']],
            [['driver_id'], 'exist', 'skipOnError' => true, 'targetClass' => Driver::className(), 'targetAttribute' => ['driver_id' => 'id']],
	        [['town', 'town_center', 'km_price'], 'required', 'when' => function($model){
		        return $model->use_new_tariffs;
	        }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'car_id' => 'Автомобиль',
            'driver_id' => 'Водитель',
            'use_new_tariffs' => 'Использовать новые тарифы',
	        'town' => 'Уфа',
	        'town_center' => 'Уфа(центр)',
	        'km_price' => 'Межгород',
        ];
    }

	/**
     * @return \yii\db\ActiveQuery
     */
    public function getCar()
    {
        return $this->hasOne(Car::className(), ['id' => 'car_id']);
    }

	public function getDriver()
	{
		return $this->hasOne(Driver::className(), ['id' => 'driver_id']);
	}
}
