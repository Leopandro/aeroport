<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "driver_tariff".
 *
 * @property integer $id
 * @property integer $town
 * @property integer $town_center
 * @property integer $km_price
 *
 * @property Driver $id0
 */
class DriverTariff extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'driver_tariff';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['town', 'town_center'], 'integer'],
	        [['km_price'], 'string', 'max' => 128],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Car::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'town' => 'Уфа',
            'town_center' => 'Уфа(центр)',
            'km_price' => 'Межгород(руб./км)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Driver::className(), ['id' => 'id']);
    }
}
