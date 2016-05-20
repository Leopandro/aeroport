<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tariff */

$this->title = Yii::t('app', 'Create Tariff');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tariffs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tariff-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
