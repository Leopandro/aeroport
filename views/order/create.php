<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = Yii::t('app', 'Create Order');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?

    if (Yii::$app->user->identity->role_id == 2 || Yii::$app->user->identity->role_id == 5)
    {
	    echo $this->render('_user_form', [
		    'model' => $model,
	    ]);
	}
    else
        echo $this->render('_admin_form', [
	    'model' => $model,
    ]);
    ?>

</div>
