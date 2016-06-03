<?php

use yii\db\Migration;

class m160603_101815_add_driver_fields extends Migration
{
    public function up()
    {
		$this->addColumn(\app\models\Driver::tableName(), 'rating', $this->integer());
		$this->addColumn(\app\models\Driver::tableName(), 'license', $this->smallInteger());
    }

    public function down()
    {
	    $this->dropColumn(\app\models\Driver::tableName(), 'rating');
	    $this->dropColumn(\app\models\Driver::tableName(), 'license');
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
