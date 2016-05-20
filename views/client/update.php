<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Client */

$this->title = Yii::t('app', 'Update Client');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => empty($user->info->title) ? 'Юр.лицо' : $user->info->title, 'url' => ['update', 'id' => $user->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="row" style="margin-top: 20px;">
	<div class="col-md-12">
		<h3><?= Html::encode($this->title) ?></h3>
		<div class="panel panel-default">
			<div class="panel-body">
				<?php $form = ActiveForm::begin([
					'layout' => 'horizontal',
					'enableAjaxValidation'   => false,
					'enableClientValidation' => true,
					'fieldConfig' => [
						'horizontalCssClasses' => [
							'wrapper' => 'col-sm-9',
						],
					],
				]); ?>

				<?= $this->render('_form', ['form' => $form, 'user' => $user]) ?>

				<div class="form-group">
					<div class="col-lg-offset-3 col-lg-9">
						<?= Html::submitButton(Yii::t('user', 'Save'), ['class' => 'btn btn-block btn-success']) ?>
					</div>
				</div>

				<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>
</div>