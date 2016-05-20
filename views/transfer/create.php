<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Way */

$this->title = Yii::t('app', 'Create Transfer');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ways'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="way-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
