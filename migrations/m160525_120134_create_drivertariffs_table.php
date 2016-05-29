<?php

use yii\db\Migration;

/**
 * Handles the creation for table `drivertariffs_table`.
 */
class m160525_120134_create_drivertariffs_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('driver_tariff', [
            'id' => $this->primaryKey(),
	        'town' => $this->integer(),
	        'town_center' => $this->integer(),
	        'km_price' => $this->integer()
        ]);
	    $this->addForeignKey('driver_tariff_driver_id', 'driver_tariff', 'id', 'driver', 'id', 'CASCADE', 'NO ACTION');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('driver_tariff');
    }
}
