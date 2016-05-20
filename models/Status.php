<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "status".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Order[] $orders
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 32],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['status_id' => 'id']);
    }

	public static function getStatusListForDropDownList()
	{
		$query = (new Query())
			->select('*')
			->from(Status::tableName())
			->all();
		$arr = ArrayHelper::map($query, 'id', 'name');
		return $arr;
	}

	public static function getStatusById($id)
	{
		return self::getStatusListForDropDownList()[$id];
	}
}
