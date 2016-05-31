<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Panel */

$this->title = 'Обновить стоянку';
$this->params['breadcrumbs'][] = ['label' => 'Стоянка', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="panel-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
