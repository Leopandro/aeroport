<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = Yii::t('app', 'Update Order') . ' № '. $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="order-update">

    <h1><?= Html::encode($this->title) ?></h1>
	<?
	if(Yii::$app->user->identity->role_id == 2 || Yii::$app->user->identity->role_id == 6)
	{
		echo $this->render('_user_form', [
			'model' => $model,
		]);
	}
	elseif(Yii::$app->user->identity->role_id == 1 || Yii::$app->user->identity->role_id == 3 || Yii::$app->user->identity->role_id == 5)
	{
		echo $this->render('_admin_form', [
			'model' => $model,
		]);
	}

	?>

</div>
