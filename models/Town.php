<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "town".
 *
 * @property integer $id
 * @property string $name
 */
class Town extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'town';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 64],
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

	public static function getTownsForDropDownList()
	{
		$result = (new Query())
			->select('*')
			->from(Town::tableName())
			->all();
		$arr = [];
		foreach ($result as $item)
		{
			$arr[$item['id']] = $item['name'];
		}
		return $arr;
	}

	public static function getTownById($id)
	{
		$result = (new Query())
			->select('name')
			->from(Town::tableName())
			->one();
		return $result['name'];
	}
}
