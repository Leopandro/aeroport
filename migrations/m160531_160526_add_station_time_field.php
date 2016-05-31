<?php

use yii\db\Migration;

class m160531_160526_add_station_time_field extends Migration
{
    public function up()
    {
		$this->addColumn(\app\models\Panel::tableName(), 'station_time', $this->integer());
    }

    public function down()
    {
	    $this->dropColumn(\app\models\Panel::tableName(), 'station_time');
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
