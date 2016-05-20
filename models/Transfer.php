<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "way".
 *
 * @property integer $id
 * @property integer $town_from_id
 * @property integer $town_to_id
 *
 * @property Town $townTo
 * @property Town $townFrom
 */
class Transfer extends \yii\db\ActiveRecord
{
	public $tariffs;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transfer';
    }

    /**
     * @inheritdoc
     */

	public function saveTariffs($rows = [])
	{
		TransferTariffMin::deleteAll(['transfer_id' => $this->id]);
		$model = new TransferTariffMin();
		if ($rows != [])
			foreach ($rows as $row)
			{
				$row['transfer_id'] = $this->id;
				$model->attributes = $row;
				if ($model->validate())
				{
					$model->save();
//					$model->offsetUnset(['id']);
				}
			}
		$x = 1;
	}

	public function loadTariffs()
	{
		$result = (new Query())
			->select('id')
			->from(TransferTariffMin::tableName())
			->where(['transfer_id' => $this->id])
			->all();
		$arr[0] = new TransferTariffMin();
		foreach ($result as $item)
		{
			$arr[$item['id']] = TransferTariffMin::findOne(['id' => $item['id']]);
		}
		$this->tariffs = $arr;
	}

    public function rules()
    {
        return [
            [['town_from_id', 'town_to_id', 'distance'], 'integer'],
            [['town_to_id'], 'exist', 'skipOnError' => true, 'targetClass' => Point::className(), 'targetAttribute' => ['town_to_id' => 'id']],
            [['town_from_id'], 'exist', 'skipOnError' => true, 'targetClass' => Point::className(), 'targetAttribute' => ['town_from_id' => 'id']],
	        [['town_from_id', 'town_to_id', 'distance'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'town_from_id' => Yii::t('app', 'Point from'),
            'town_to_id' => Yii::t('app', 'Point to'),
            'distance' => Yii::t('app', 'Distance'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTownTo()
    {
        return $this->hasOne(Town::className(), ['id' => 'town_to_id']);
    }

	public static function getPointsForDropDownList()
	{
		$result = Point::find()
			->joinWith(Town::tableName())
			->all();
		$arr = [];
		foreach ($result as $item)
		{
			$arr[$item['id']] = $item['address'].', город '.$item['town']['name'];
		}
//		$arr = ArrayHelper::map($result, 'id', ['address']);
		return $arr;
	}

	public static function getPointById($id)
	{
		$arr = self::getPointsForDropDownList();
		$item = $arr[$id];
		return $item;
	}


//	public static function getPointsForDropDownList()
//	{
//
//	}
    /**
     * @return \yii\db\ActiveQuery
     */
//    public function getPointById()
//    {
//        return $this->hasOne(Town::className(), ['id' => 'town_from_id']);
//    }
}
