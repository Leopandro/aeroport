<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tr */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="way-form">

	<?= $form->field($model, 'town_from_id')->dropDownList(
		\app\models\Transfer::getPointsForDropDownList(),
		[
			'prompt' => Yii::t('app', 'Choose town')
		])
	?>

	<?= $form->field($model, 'town_to_id')->dropDownList(
		\app\models\Transfer::getPointsForDropDownList(),
		[
			'prompt' => Yii::t('app', 'Choose town')
		])
	?>

	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
