<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 12.06.2016
 * Time: 20:36
 */

?>

<div class="panel panel-default">
	<div class="panel-heading">
		Тарифы
	</div>
	<div class="panel-body">
		<?= \yii\bootstrap\Html::input()?>
		<?= $form->field($model, 'town_center')->textInput() ?>

		<?= $form->field($model, 'town')->textInput() ?>

		<?= $form->field($model, 'km_price')->textInput() ?>
	</div>
</div>
