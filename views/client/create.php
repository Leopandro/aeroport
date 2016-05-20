<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Nav;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Client */

$this->title = Yii::t('user', 'Create a user account');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?//= $this->render('/_alert', [
//    'module' => Yii::$app->getModule('user'),
//]) ?>

<?//= $this->render('_menu') ?>

<div class="row" style="margin-top: 20px;">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="alert alert-info">
					<?= Yii::t('user', 'Credentials will be sent to the user by email') ?>.
					<?= Yii::t('user', 'A password will be generated automatically if not provided') ?>.
				</div>
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