<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 21.04.2016
 * Time: 18:28
 */

class TariffPrice extends \yii\base\Model
{
	public $tariff_id;
	public $price;

	public function attributeLabels()
	{
		return [
			'tariff_id' => 'Тариф',
			'price' => 'Цена'
		];
	}
}