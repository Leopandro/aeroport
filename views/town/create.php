<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Town */

$this->title = Yii::t('app', 'Create Town');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Towns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="town-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
