<?php

use yii\db\Migration;

class m160612_115651_change_km_price_field_type extends Migration
{
    public function up()
    {
		$this->alterColumn(\app\models\DriverTariff::tableName(), 'km_price', $this->string(128));
    }

    public function down()
    {
	    $this->dropColumn(\app\models\DriverTariff::tableName(), 'km_price');
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
