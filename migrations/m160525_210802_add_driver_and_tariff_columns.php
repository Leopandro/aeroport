<?php

use yii\db\Migration;

class m160525_210802_add_driver_and_tariff_columns extends Migration
{
    public function up()
    {
		$this->addColumn(\app\models\Panel::tableName(), 'driver_id', $this->integer());
	    $this->addForeignKey('panel_driver_id', \app\models\Panel::tableName(), 'driver_id', \app\models\Driver::tableName(), 'id', 'CASCADE', 'NO ACTION');
    }

    public function down()
    {
	    $this->dropColumn(\app\models\Panel::tableName(), 'driver_id');
	    $this->dropForeignKey('panel_driver_id', \app\models\Panel::tableName());
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
