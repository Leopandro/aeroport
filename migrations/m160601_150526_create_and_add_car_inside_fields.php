<?php

use yii\db\Migration;

/**
 * Handles the creation for table `and_add_car_inside_fields`.
 */
class m160601_150526_create_and_add_car_inside_fields extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('car_inside', [
            'id' => $this->primaryKey(),
	        'car_id' => $this->integer(),
	        'image' => $this->string(32)
        ]);
	    $this->addForeignKey('car_inside_car_id', 'car_inside', 'car_id', \app\models\Car::tableName(), 'id', 'CASCADE', 'NO ACTION');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
	    $this->dropForeignKey('car_inside_car_id', 'car_inside');
        $this->dropTable('car_inside');
    }
}
