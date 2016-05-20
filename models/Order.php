<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property string $date_create
 * @property string $date_update
 * @property string $datetime_booking
 * @property integer $status_id
 * @property integer $from_point_id
 * @property integer $to_point_id
 * @property string $text_table
 * @property integer $car_class_id
 * @property integer $car_id
 * @property integer $tariff_id
 * @property integer $passengers
 * @property string $comment
 *
 * @property Status $status
 * @property Car $car
 * @property Point $fromPoint
 * @property Tariff $tariff
 * @property Point $toPoint
 */
class Order extends \yii\db\ActiveRecord
{

	public $address;
	public $time;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_create', 'date_update'], 'safe'],
            [['status_id', 'from_point_id', 'to_point_id', 'car_class_id', 'car_id', 'tariff_id', 'driver_id'], 'integer'],
	        [['passengers'], 'number', 'min' => 1, 'max' => 24],
            [['text_table'], 'string', 'max' => 256],
            [['comment'], 'string', 'max' => 1024],
	        [['driver_id'], 'exist', 'skipOnError' => true, 'targetClass' => Driver::className(), 'targetAttribute' => ['driver_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['car_id'], 'exist', 'skipOnError' => true, 'targetClass' => Car::className(), 'targetAttribute' => ['car_id' => 'id']],
            [['from_point_id'], 'exist', 'skipOnError' => true, 'targetClass' => Point::className(), 'targetAttribute' => ['from_point_id' => 'id']],
            [['tariff_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tariff::className(), 'targetAttribute' => ['tariff_id' => 'id']],
            [['to_point_id'], 'exist', 'skipOnError' => true, 'targetClass' => Point::className(), 'targetAttribute' => ['to_point_id' => 'id']],
	        [['datetime_booking', 'status_id', 'from_point_id', 'to_point_id', 'tariff_id', 'passengers', 'time'], 'required'],
	        [['driver_id', 'car_id'], 'required', 'on' => 'purpose']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date_create' => Yii::t('app', 'Date Create'),
            'date_update' => Yii::t('app', 'Date Update'),
            'datetime_booking' => Yii::t('app', 'Дата заказа'),
            'status_id' => Yii::t('app', 'Status'),
            'from_point_id' => Yii::t('app', 'Пункт'),
            'to_point_id' => Yii::t('app', 'Пункт'),
            'text_table' => Yii::t('app', 'Text Table'),
            'car_class_id' => Yii::t('app', 'Car Class ID'),
            'car_id' => Yii::t('app', 'Car'),
            'driver_id' => Yii::t('app', 'Driver'),
            'tariff_id' => Yii::t('app', 'Tariff'),
            'passengers' => Yii::t('app', 'Passengers'),
            'comment' => Yii::t('app', 'Комментарий'),
	        'client_id' => Yii::t('app', 'Client'),
	        'time' => Yii::t('app', 'Время')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
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
    public function getFromPoint()
    {
        return $this->hasOne(Point::className(), ['id' => 'from_point_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTariff()
    {
        return $this->hasOne(Tariff::className(), ['id' => 'tariff_id']);
    }

	public function getClient()
	{
		return $this->hasOne(User::className(), ['id' => 'client_id']);
	}

	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'client_id']);
	}

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToPoint()
    {
        return $this->hasOne(Point::className(), ['id' => 'to_point_id']);
    }

	public function loadAddress()
	{
		if ($this->isNewRecord)
		{
			$this->address = new Address();
		}
		else
		{
			$this->address = Address::findOne(['order_id' => $this->id]);
		}
	}

	public function afterSave($insert, $changedAttributes)
	{
		$this->address->order_id = $this->id;
		$this->address->save();
	}
}
