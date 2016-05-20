<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Nav;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\models\Client */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="client-form">
	<div class="panel panel-default">
		<div class="panel-heading">Данные для входа</div>
		<div class="panel-body">
		<?= $form->field($user, 'email')->textInput(['maxlength' => 255]) ?>
		<?= $form->field($user, 'username')->textInput(['maxlength' => 255]) ?>
		<?= $form->field($user, 'role_id')->dropDownList(\app\models\User::getClientRolesDropdownlist()) ?>
		<?= $form->field($user, 'password')->passwordInput() ?>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">Клиентские данные</div>
		<div class="panel-body">
			<?= $this->render('_legal', [
				'form' => $form,
				'model' => $user->info
			]) ?>
		</div>
	</div>


</div>
