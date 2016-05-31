<?php

use yii\db\Migration;

class m160531_163237_add_create_update_fields extends Migration
{
    public function up()
    {
		$this->addColumn(\app\models\Panel::tableName(), 'date_create', $this->integer());
	    $this->addColumn(\app\models\Panel::tableName(), 'date_update', $this->integer());
    }

    public function down()
    {
	    $this->dropColumn(\app\models\Panel::tableName(), 'date_create');
	    $this->dropColumn(\app\models\Panel::tableName(), 'date_update');
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
