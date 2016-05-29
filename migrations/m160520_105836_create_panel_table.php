<?php

use yii\db\Migration;

/**
 * Handles the creation for table `panel_table`.
 */
class m160520_105836_create_panel_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('panel', [
            'id' => $this->primaryKey(),
	        'car_id' => $this->integer(),
        ]);

	    $this->addForeignKey('panel_car_id', 'panel', 'car_id', \app\models\Car::tableName(), 'id', 'CASCADE', 'NO ACTION');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('panel');
    }
}
