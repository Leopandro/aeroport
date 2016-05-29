<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Car */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="car-form">

    <?php $form = ActiveForm::begin([
	    'options' => [
		    'enctype' => 'multipart/form-data'
	    ]
    ]); ?>

	<?
		if ($model->image)
			echo Html::img(Yii::getAlias('/web/files/images/').$model->image, [
				'width' => '240px',
				'height' => '180px'
			]);
	?>

    <?= $form->field($model, 'image')->fileInput() ?>

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
