<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Car */
/* @var $form yii\widgets\ActiveForm */
$jsFirst = <<< JS
function readURL(input) {
  if (input.files && input.files[0]) {
  	img = $(input).parent().parent().next().children('img');
    var reader = new FileReader();
    reader.onload = function (e) {
      $(img)
        .attr('src', e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
  }
}
JS;
$js = <<< JS
$('panel-body input[type="file"]').change(function(){
	console.log($(this));
});
console.log('readURL defined')
JS;

$this->registerJs($jsFirst, yii\web\View::POS_HEAD);
?>

<div class="car-form">

    <?php $form = ActiveForm::begin([
	    'options' => [
		    'enctype' => 'multipart/form-data',
		    'id' => 'dynamic-form'
	    ]
    ]); ?>

	<?= $form->field($model, 'image')->fileInput() ?>

	<?
		if ($model->image)
			echo Html::img(Yii::getAlias('/web/files/images/').$model->image, [
				'width' => '240px',
				'height' => '180px'
			]);
	?>

	<?php DynamicFormWidget::begin([
		'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
		'widgetBody' => '.container-items', // required: css class selector
		'widgetItem' => '.item', // required: css class
		'limit' => 6, // the maximum times, an element can be cloned (default 999)
		'min' => 1, // 0 or 1 (default 1)
		'insertButton' => '.add-item', // css class
		'deleteButton' => '.remove-item', // css class
		'model' => $model->car_inside[0],
		'formId' => 'dynamic-form',
		'formFields' => [
			'id',
			'image'
		],
	]); ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-picture-o"></i> Вид авто изнутри
			<button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить фото</button>
			<div class="clearfix"></div>
		</div>
		<div class="panel-body container-items"><!-- widgetContainer -->
			<?php foreach ($model->car_inside as $index => $CarInside): ?>
				<div class="item panel panel-default"><!-- widgetBody -->
					<div class="panel-heading">
						<span class="panel-title-address">Автомобиль</span>
						<button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
						<div class="clearfix"></div>
					</div>
					<div class="panel-body">
						<?php
						// necessary for update action.
						if (!$CarInside->isNewRecord) {
							echo Html::activeHiddenInput($CarInside, "[{$index}]id");
						}
						?>

						<div class="row">
							<div class="col-sm-6">
								<?= $form->field($CarInside, "[{$index}]image")->fileInput([
									'class' => 'file-preload',
									'onchange' => 'readURL(this);'
								]) ?>
							</div>
							<div class="col-sm-6">
								<img src="<?= Yii::getAlias('/web/files/images/').$CarInside->car_id.'/'.$CarInside->image?>" class="image-preview" alt="your image" style="width: 170px; height: auto;"/>
							</div>
						</div><!-- end:row -->
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php DynamicFormWidget::end(); ?>

    <?= $form->field($model, 'company')->dropDownList(\app\models\CarBrand::getCarBrandForDropDownList()) ?>

    <?= $form->field($model, 'model')->textInput() ?>

    <?= $form->field($model, 'class')->dropDownList(\app\models\Car::getClassesForDropdownlist()) ?>

    <?= $form->field($model, 'year')->textInput() ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'color')->textInput() ?>

    <?= $form->field($model, 'number_of_passengers')->textInput() ?>

    <?= $form->field($model, 'baby_chair')->radioList([
	    '0' => 'Нет',
	    '1' => 'Да',
    ]) ?>

    <?= $form->field($model, 'conditioner')->radioList([
	    '0' => 'Нет',
	    '1' => 'Да',
    ]) ?>

    <?= $form->field($model, 'baggage_count')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
