<?php

use yii\db\Migration;

class m160610_162938_change_tariff_foreign_key extends Migration
{
    public function up()
    {
	    $this->delete(\app\models\DriverTariff::tableName());
		$this->dropForeignKey('driver_tariff_driver_id', \app\models\DriverTariff::tableName());
	    $this->addForeignKey('driver_tariff_car_id', \app\models\DriverTariff::tableName(), 'id', \app\models\Car::tableName(), 'id', 'NO ACTION', 'NO ACTION');
    }

    public function down()
    {
        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
