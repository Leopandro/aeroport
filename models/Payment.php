<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property integer $id
 * @property integer $client_id
 * @property string $link_pdf
 * @property integer $status
 */
class Payment extends \yii\db\ActiveRecord
{
	public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_id', 'status'], 'integer'],
            [['link_pdf'], 'string', 'max' => 64],
	        [['file'], 'file', 'extensions' => 'pdf', 'maxSize' => '10000000'],
	        [['file'], 'required', 'on' => 'create']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'link_pdf' => 'Файл в формате pdf',
            'file' => 'Файл в формате pdf',
            'status' => 'Status',
        ];
    }

	public function upload()
	{
		$path = Yii::getAlias('@app/files/pdf/');
		if (!is_dir($path)) mkdir($path, 0777, true);
		$filename = Yii::$app->security->generateRandomString(9);
		$this->file->saveAs($path . $filename . '.' . $this->file->extension);
		return $filename . '.' . $this->file->extension;
	}
}
