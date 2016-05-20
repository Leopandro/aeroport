<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "car_brand".
 *
 * @property integer $id
 * @property string $name
 */
class CarBrand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'car_brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

	public static function getCarBrandForDropDownList()
	{
		return ArrayHelper::map(CarBrand::find()->all(), 'id', 'name');
	}

	public static function getCarBrandById($id)
	{
		return self::getCarBrandForDropDownList()[$id];
	}
}
