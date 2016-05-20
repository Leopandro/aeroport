<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Point */

$this->title = Yii::t('app', 'Create Point');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Points'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="point-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
