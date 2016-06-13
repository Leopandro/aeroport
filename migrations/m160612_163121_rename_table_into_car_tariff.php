<?php

use yii\db\Migration;

class m160612_163121_rename_table_into_car_tariff extends Migration
{
    public function up()
    {
		$this->renameTable('driver_tariff', 'car_tariff');
    }

    public function down()
    {
	    $this->renameTable('car_tariff', 'driver_tariff');
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
