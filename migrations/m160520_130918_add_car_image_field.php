<?php

use yii\db\Migration;

class m160520_130918_add_car_image_field extends Migration
{
    public function up()
    {
		$this->addColumn(\app\models\Car::tableName(), 'image', $this->string(64));
    }

    public function down()
    {
	    $this->dropColumn(\app\models\Car::tableName(), 'image');
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
