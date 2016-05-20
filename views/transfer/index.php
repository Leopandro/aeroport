<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransferSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ways');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="way-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Way'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
	        [
		        'attribute' => 'town_from_id',
		        'value' => function($model)
		        {
			        return \app\models\Transfer::getPointById($model->town_from_id);
		        },
		        'filter' => Html::activeDropDownList(
			        $searchModel,
			        'town_from_id',
			        \app\models\Transfer::getPointsForDropDownList(),
			        [
				        'prompt' => Yii::t('app', 'Choose point')
			        ])
	        ],
			[
				'attribute' => 'town_to_id',
				'value' => function($model)
				{
					return \app\models\Transfer::getPointById($model->town_to_id);
				},
				'filter' => Html::activeDropDownList(
					$searchModel,
					'town_to_id',
					\app\models\Transfer::getPointsForDropDownList(),
					[
						'prompt' => Yii::t('app', 'Choose point')
					])
			],
	        'distance',
	        [
		        'class' => 'yii\grid\ActionColumn',
		        'template' => '{update}, {delete}'
	        ],
        ],
    ]); ?>
</div>
