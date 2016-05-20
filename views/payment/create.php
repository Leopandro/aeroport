<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Payment */

$this->title = 'Заявка на пополнение баланса';
//$this->params['breadcrumbs'][] = ['label' => 'Payments', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-create">

    <h3><?= 'Оставить заявку на пополнение баланса' ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
