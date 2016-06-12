<?php

use yii\db\Migration;

class m160612_122243_add_permition_field_car extends Migration
{
    public function up()
    {
		$this->addColumn(\app\models\Car::tableName(), 'permission_to_drive', $this->smallInteger().' DEFAULT 1');
    }

    public function down()
    {
	    $this->dropColumn(\app\models\Car::tableName(), 'permission_to_drive');
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
