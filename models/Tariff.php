<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tariff".
 *
 * @property integer $id
 * @property string $name
 * @property integer $km_price
 * @property integer $hour_price
 * @property integer $min_time
 * @property integer $extra_race
 */
class Tariff extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tariff';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['km_price', 'hour_price', 'min_time', 'extra_race'], 'integer'],
            [['km_price', 'hour_price', 'min_time', 'extra_race'], 'required'],
            [['name'], 'string', 'max' => 64],
        ];
    }

	public static function getTariffForDropDownList()
	{
		$result = (new Query())
			->select('*')
			->from(Tariff::tableName())
			->all();
		return ArrayHelper::map($result, 'id', 'name');
	}

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'km_price' => Yii::t('app', 'Km Price'),
            'hour_price' => Yii::t('app', 'Hour Price'),
            'min_time' => Yii::t('app', 'Min Time'),
            'extra_race' => Yii::t('app', 'Extra Race'),
        ];
    }
}
