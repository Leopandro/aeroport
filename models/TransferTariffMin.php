<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transfer_tariff_min".
 *
 * @property integer $id
 * @property integer $transfer_id
 * @property integer $tariff_id
 * @property integer $price
 */
class TransferTariffMin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transfer_tariff_min';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transfer_id', 'tariff_id', 'price'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'transfer_id' => Yii::t('app', 'Transfer'),
            'tariff_id' => Yii::t('app', 'Tariff'),
            'price' => Yii::t('app', 'Price'),
        ];
    }
}
