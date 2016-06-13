<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Panel */
/* @var $form yii\widgets\ActiveForm */
$urlGetDrivers = \yii\helpers\Url::to('/driver/get-drop-down-drivers');
$urlGetTariff = \yii\helpers\Url::to('/panel/get-cars-tariff');
$script = <<< JS
function replaceCarsDropDown()
{
	$.ajax({
		url : '$urlGetDrivers',
		type : 'post',
		data : {
			id : $('#panel_car_value_select2').val(),
			//order_id: $model->id
		},
		success : function(data){
			$('#panel-driver_id').empty();
			$('#panel-driver_id').append($(data).children());
		}
	})
}
function getTariffPrice()
{
	$.ajax({
		url : '$urlGetTariff',
		type : 'post',
		data : {
			id : $('#panel_car_value_select2').val(),
		},
		success : function(data){
			data = JSON.parse(data);
			if (data != null)
			{
				$('#panel-town').val(data['town']);
				$('#panel-town_center').val(data['town_center']);
				$('#panel-km_price').val(data['km_price']);
			}
			else {
				$('#panel-town').val('');
				$('#panel-town_center').val('');
				$('#panel-km_price').val('');
			}
		}
	});
}
$('#panel_car_value_select2').on('change', function(){
	replaceCarsDropDown();
	getTariffPrice()
});
replaceCarsDropDown();
if ('$model->isNewRecord' == 1)
	getTariffPrice();
	console.log('$model->isNewRecord');
//$('.main-form').removeClass('hidden');
JS;


$this->registerJs($script, \yii\web\View::POS_LOAD);
?>

<div class="panel-form main-form">

    <?php $form = ActiveForm::begin(); ?>

<!--	--><?//= $form->field($model, 'car_id')->dropDownList(\app\models\Car::getCarsForDropDownList(), [
//		'prompt' => '-- Выберите --'
//	]) ?>

	<?= $form->field($model, 'car_id')->widget(Select2::className(), [
		'data' => \app\models\Car::getCarsForDropDownList(),
		'options' => [
			'id' => 'panel_car_value_select2'
		]
	]) ?>

	<?= $form->field($model, 'driver_id')->dropDownList([],
		[
			'prompt' => '-- Выберите --'
		])	?>

<!--	--><?//= $form->field($model, 'car_id')->dropDownList([], ['prompt' => 'Выберите авто'])	?>

	<?= $form->field($model, 'station_time')->textInput() ?>

	<?= $form->field($model, 'use_new_tariffs')->checkbox() ?>

	<div class="panel panel-default">
		<div class="panel-heading">
			Тарифы
		</div>
		<div class="panel-body">
			<?= $form->field($model, 'town_center')->textInput() ?>

			<?= $form->field($model, 'town')->textInput() ?>

			<?= $form->field($model, 'km_price')->textInput() ?>
		</div>
	</div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Применить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
