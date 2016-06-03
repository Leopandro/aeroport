<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "car_inside".
 *
 * @property integer $id
 * @property integer $car_id
 * @property string $image
 *
 * @property Car $car
 */
class CarInside extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'car_inside';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['car_id'], 'integer'],
            [['image'], 'file', 'extensions' => 'jpg, jpeg, png'],
            [['car_id'], 'exist', 'skipOnError' => true, 'targetClass' => Car::className(), 'targetAttribute' => ['car_id' => 'id']],
	        [['car_id', 'image'], 'required', 'on' => 'save'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'car_id' => 'Car ID',
            'image' => 'Фото',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCar()
    {
        return $this->hasOne(Car::className(), ['id' => 'car_id']);
    }

	public function uploadImage()
	{
		if (!$this->image)
			return false;
		$path = Yii::getAlias('@app/web/files/images/'.$this->car_id.'/');
		if (!is_dir($path)) mkdir($path, 0777, true);
		$filename = Yii::$app->security->generateRandomString(9);
		$this->image->saveAs($path . $filename . '.' . $this->image->extension);
		$this->image = $filename . '.' . $this->image->extension;
		return true;
	}
}
