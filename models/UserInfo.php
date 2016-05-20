<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_info".
 *
 * @property integer $id
 * @property string $title
 * @property string $legal_name
 * @property integer $inn
 * @property string $address
 * @property string $responsible
 * @property string $contact_number
 * @property string $mailing_address
 */
class UserInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inn', 'contact_number', 'balance'], 'integer'],
            [['title', 'responsible'], 'string', 'max' => 128],
            [['legal_name', 'mailing_address'], 'string', 'max' => 256],
            [['address'], 'string', 'max' => 512],
	        [['title', 'responsible'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'legal_name' => Yii::t('app', 'Legal Name'),
            'inn' => Yii::t('app', 'Inn'),
            'address' => Yii::t('app', 'Address'),
            'responsible' => Yii::t('app', 'Responsible'),
            'contact_number' => Yii::t('app', 'Contact Number'),
            'mailing_address' => Yii::t('app', 'Mailing Address'),
	        'balance' => Yii::t('app', 'Balance')
        ];
    }
}
