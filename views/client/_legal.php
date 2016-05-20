<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserInfo */
/* @var $form ActiveForm */
?>
<div class="client-_legal">
        <?= $form->field($model, 'inn') ?>
        <?= $form->field($model, 'title') ?>
        <?= $form->field($model, 'responsible') ?>
        <?= $form->field($model, 'legal_name') ?>
        <?= $form->field($model, 'mailing_address') ?>
        <?= $form->field($model, 'address') ?>
        <?= $form->field($model, 'contact_number') ?>
</div><!-- client-_legal -->
