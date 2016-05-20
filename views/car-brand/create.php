<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CarBrand */

$this->title = Yii::t('app', 'Create Car Brand');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Car Brands'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-brand-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
