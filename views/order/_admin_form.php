<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */

$urlGetCars = \yii\helpers\Url::to('/driver/get-drop-down');
$urlGetAddress = \yii\helpers\Url::to('/point/get-address-info');

$script = <<< JS
function replaceCarsDropDown()
{
	$.ajax({
		url : '$urlGetCars',
		type : 'post',
		data : {id : $('#order-driver_id').val()},
		success : function(data){
			$('#order-car_id').empty();
			$('#order-car_id').append(data);
		}
	})
}
function replacePointInfo(selector, streetSelector, homeSelector)
{
	$.ajax({
		url : '$urlGetAddress',
		type : 'post',
		data : {id : $(selector).val()},
		success : function(data){
			if (data != 'false')
			{
				$(streetSelector).val(data['street']);
				$(homeSelector).val(data['home']);
			}
		}
	})
}
$('#order-driver_id').on('input', function(){
	replaceCarsDropDown();
});
$('#order-from_point_id').on('input', function(){
	replacePointInfo('#order-from_point_id', '#address-from_street', '#address-from_home');
});
$('#order-to_point_id').on('input', function(){
	replacePointInfo('#order-to_point_id', '#address-to_street', '#address-to_home');
});
replaceCarsDropDown();
JS;


$this->registerJs($script, \yii\web\View::POS_LOAD);
?>

<div class="order-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'datetime_booking')->widget(\yii\jui\DatePicker::className(), [
		'language' => 'ru',
		'size' => 'ms',
		'options' => ['placeholder' => Yii::t('app', 'Choose time')],
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
	<?= $form->field($model, 'driver_id')->dropDownList(\app\models\Driver::getDriversForDropdownList(),
		[
			'prompt' => 'Выберите водителя'
		])	?>

	<?= $form->field($model, 'car_id')->dropDownList([], ['prompt' => 'Выберите авто'])	?>

	<?= $form->field($model, 'status_id')->dropDownList(\app\models\Status::getStatusListForDropDownList()); ?>

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
