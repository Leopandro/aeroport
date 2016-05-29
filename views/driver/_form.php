<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
/* @var $this yii\web\View */
/* @var $model app\models\Driver */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="driver-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'town_id')->dropDownList(\app\models\Town::getTownsForDropDownList()) ?>

<!--    --><?//= $form->field($model, 'car_id')->dropDownList(\app\models\Car::getCarsForDropDownList()) ?>

    <?= $form->field($model, 'phone_number')->textInput() ?>

    <?= $form->field($model, 'experience')->textInput() ?>

<!--    --><?//= $form->field($model, 'phone_number_2')->textInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

	<?php DynamicFormWidget::begin([
		'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
		'widgetBody' => '.container-items', // required: css class selector
		'widgetItem' => '.item', // required: css class
		'limit' => 4, // the maximum times, an element can be cloned (default 999)
		'min' => 0, // 0 or 1 (default 1)
		'insertButton' => '.add-item', // css class
		'deleteButton' => '.remove-item', // css class
		'model' => $model->cars[0],
		'formId' => 'dynamic-form',
		'formFields' => [
//			'driver_id',
			'car_id'
		],
	]); ?>


	<div class="panel panel-default">
		<div class="panel-heading">
			Тарифы
		</div>
		<div class="panel-body">
			<?= $form->field($model->tariffs, 'town')->textInput() ?>

			<?= $form->field($model->tariffs, 'town_center')->textInput() ?>

			<?= $form->field($model->tariffs, 'km_price')->textInput() ?>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-envelope"></i> Автомобили
			<button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить авто</button>
			<div class="clearfix"></div>
		</div>
		<div class="panel-body container-items"><!-- widgetContainer -->
			<?php foreach ($model->cars as $index => $modelCar): ?>
				<div class="item panel panel-default"><!-- widgetBody -->
					<div class="panel-heading">
						<span class="panel-title-address">Автомобиль</span>
						<button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
						<div class="clearfix"></div>
					</div>
					<div class="panel-body">
						<?php
						// necessary for update action.
						if (!$modelCar->isNewRecord) {
							echo Html::activeHiddenInput($modelCar, "[{$index}]id");
						}
						?>

						<div class="row">
							<div class="col-sm-6">
								<?= $form->field($modelCar, "[{$index}]car_id")->dropDownList(\app\models\Car::getCarsForDropDownList(), [
									'prompt' => '-- Выберите --'
								]) ?>
							</div>
						</div><!-- end:row -->
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php DynamicFormWidget::end(); ?>

	<?= $form->field($model, 'comment')->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
