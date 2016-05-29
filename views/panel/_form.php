<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Panel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'driver_id')->dropDownList(\app\models\Driver::getDriversForDropdownList(),
		[
			'prompt' => 'Выберите водителя'
		])	?>

<!--	--><?//= $form->field($model, 'car_id')->dropDownList([], ['prompt' => 'Выберите авто'])	?>

	<?= $form->field($model, 'car_id')->dropDownList(\app\models\Car::getCarsForDropDownList()) ?>

	<?= $form->field($model, 'use_new_tariffs')->checkbox() ?>

	<div class="panel panel-default">
		<div class="panel-heading">
			Тарифы
		</div>
		<div class="panel-body">
			<?= $form->field($model, 'town')->textInput() ?>

			<?= $form->field($model, 'town_center')->textInput() ?>

			<?= $form->field($model, 'km_price')->textInput() ?>
		</div>
	</div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
