<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
/* @var $this yii\web\View */
/* @var $model app\models\Transfer    */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="way-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic_transfer_form']); ?>

    <?= $form->field($model, 'town_from_id')->dropDownList(
	    \app\models\Transfer::getPointsForDropDownList(),
	    [
		    'prompt' => Yii::t('app', 'Choose point')
	    ])
    ?>

    <?= $form->field($model, 'town_to_id')->dropDownList(
	    \app\models\Transfer::getPointsForDropDownList(),
	    [
		    'prompt' => Yii::t('app', 'Choose point')
	    ])
    ?>

	<?= $form->field($model, 'distance')->textInput();?>
	<div class="panel panel-default">

		<div class="panel-heading"><h4><i class="glyphicon glyphicon-th-list"></i> <?= Yii::t('app', 'Tariffs') ?></h4></div>
		<div class="panel-body">

			<?php DynamicFormWidget::begin([
				'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
				'widgetBody' => '.container-items', // required: css class selector
				'widgetItem' => '.item', // required: css class
				'limit' => 4, // the maximum times, an element can be cloned (default 999)
				'min' => 1, // 0 or 1 (default 1)
				'insertButton' => '.add-item', // css class
				'deleteButton' => '.remove-item', // css class
				'model' => $model->tariffs[0],
				'formId' => 'dynamic_transfer_form',
				'formFields' => [
					'tariff_id',
					'price'
				],
			]); ?>
			<div class="container-items"><!-- widgetContainer -->
				<?php foreach ($model->tariffs as $i => $modelAddress): ?>
					<div class="item panel panel-default"><!-- widgetBody -->
						<div class="panel-heading">
							<h3 class="panel-title pull-left"></h3>
							<div class="pull-right">
								<button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
								<button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="panel-body">
							<?php
							// necessary for update action.
							if (! $modelAddress->isNewRecord) {
								echo Html::activeHiddenInput($modelAddress, "[{$i}]id");
							}
							?>
							<div class="row">
								<div class="col-sm-6">
									<?= $form->field($modelAddress, "[{$i}]tariff_id")->dropDownList(\app\models\Tariff::getTariffForDropDownList(), [
										'prompt' => Yii::t('app', 'Choose tariff')
									]) ?>
									<?= $form->field($modelAddress, "[{$i}]price")->textInput(['maxlength' => true]) ?>
								</div>
							</div><!-- .row -->
						</div>
					</div>
				<?php endforeach; ?>
			</div>

			<?php DynamicFormWidget::end(); ?>
		</div>
	</div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
