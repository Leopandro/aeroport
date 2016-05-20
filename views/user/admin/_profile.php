<?php

/*
 * This file is part of the Dektrium project
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View 					$this
 * @var dektrium\user\models\User 		$user
 * @var dektrium\user\models\Profile 	$profile
 */

?>

<?php $this->beginContent('@dektrium/user/views/admin/update.php', ['user' => $user]) ?>

<?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'fieldConfig' => [
        'horizontalCssClasses' => [
            'wrapper' => 'col-sm-9',
        ],
    ],
]); ?>

<?= $form->field($profile, 'name') ?>
<?//= $form->field($profile, 'public_email') ?>
<?= $form->field($profile, 'phone') ?>
<?//= $form->field($profile, 'salary') ?>

<!--<legend>Активность</legend>-->
<!---->
<?//= $form->field($profile, 'from') ?>
<?//= $form->field($profile, 'to') ?>
<?////= $form->field($profile, 'active') ?>
<?//= $form->field($profile, 'days')->checkboxList(
//    [
//        1 => 'Понедельник',
//        2 => 'Вторник',
//        3 => 'Среда',
//        4 => 'Четверг',
//        5 => 'Пятница',
//        6 => 'Суббота',
//        7 => 'Воскресенье',
//    ]
//)?>
<?//= $form->field($profile, 'apply')->dropDownList([0 => 'Нет', 1 => 'Да']) ?>

<div class="form-group">
    <div class="col-lg-offset-3 col-lg-9">
        <?= Html::submitButton(Yii::t('user', 'Update'), ['class' => 'btn btn-block btn-success']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php $this->endContent() ?>
