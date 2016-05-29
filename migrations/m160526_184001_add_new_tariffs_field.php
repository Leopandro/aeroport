<?php

use yii\db\Migration;

class m160526_184001_add_new_tariffs_field extends Migration
{
    public function up()
    {
		$this->addColumn(\app\models\Panel::tableName(), 'use_new_tariffs', $this->smallInteger());
		$this->addColumn(\app\models\Panel::tableName(), 'town', $this->integer());
		$this->addColumn(\app\models\Panel::tableName(), 'town_center', $this->integer());
		$this->addColumn(\app\models\Panel::tableName(), 'km_price', $this->integer());
    }

    public function down()
    {
	    $this->dropColumn(\app\models\Panel::tableName(), 'use_new_tariffs');
	    $this->dropColumn(\app\models\Panel::tableName(), 'town');
	    $this->dropColumn(\app\models\Panel::tableName(), 'town_center');
	    $this->dropColumn(\app\models\Panel::tableName(), 'km_price');
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
