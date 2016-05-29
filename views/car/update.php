<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Car */

$this->title = 'Обновить автомобиль';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="car-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
