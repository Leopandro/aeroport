<?php

use yii\db\Migration;

class m160520_132728_add_car_fields extends Migration
{
    public function up()
    {
//	    $this->addColumn(\app\models\Car::tableName(), 'passengers', $this->integer());
	    $this->addColumn(\app\models\Car::tableName(), 'baby_chair', $this->integer().' DEFAULT 0');
	    $this->addColumn(\app\models\Car::tableName(), 'conditioner', $this->integer().' DEFAULT 0');
	    $this->addColumn(\app\models\Car::tableName(), 'baggage_count', $this->integer().' DEFAULT 0');
    }

    public function down()
    {
//        $this->dropColumn(\app\models\Car::tableName(), 'passengers');
        $this->dropColumn(\app\models\Car::tableName(), 'baby_chair');
        $this->dropColumn(\app\models\Car::tableName(), 'conditioner');
        $this->dropColumn(\app\models\Car::tableName(), 'baggage_count');
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
