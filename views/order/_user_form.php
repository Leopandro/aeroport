<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'datetime_booking')->widget(\yii\jui\DatePicker::className(), [
		'language' => 'ru',
//		'size' => 'ms',
		'options' => [
			'placeholder' => Yii::t('app', 'Choose time'),
			'class' => 'form-control'
		],
//		'convertFormat' => true,
//		'pluginOptions' => [
//			'format' => 'dd.mm.yyyy',
//			'todayHighlight' => true
//		]
	]);?>

	<?= $form->field($model, 'time')->textInput([
		'type' => 'time'
	])?>

<!--    --><?//= $form->field($model, 'status_id')->textInput() ?>

	<div class="panel panel-default">

		<div class="panel-heading"><h4><i class=""></i> Откуда? </h4></div>
		<div class="panel-body">
			<?= $form->field($model, 'from_point_id')->dropDownList(
				\app\models\Transfer::getPointsForDropDownList(),
				[
					'prompt' => Yii::t('app', 'Choose point')
				])?>

			<?= $form->field($model->address, 'from_street')->textInput()?>

			<?= $form->field($model->address, 'from_home')->textInput()?>
		</div>
	</div>

	<div class="panel panel-default">

		<div class="panel-heading"><h4><i class=""></i> Куда? </h4></div>
		<div class="panel-body">
			<?= $form->field($model, 'to_point_id')->dropDownList(
				\app\models\Transfer::getPointsForDropDownList(),
				[
					'prompt' => Yii::t('app', 'Choose point')
				]) ?>
			<?= $form->field($model->address, 'to_street')->textInput()?>

			<?= $form->field($model->address, 'to_home')->textInput()?>
		</div>
	</div>
<!--    --><?//= $form->field($model, 'text_table')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tariff_id')->dropDownList(\app\models\Tariff::getTariffForDropDownList(), [
	    'prompt' => Yii::t('app', 'Choose tariff')
    ]) ?>

    <?= $form->field($model, 'passengers')->textInput() ?>

    <?= $form->field($model, 'comment')->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
