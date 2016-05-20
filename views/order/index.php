<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Order'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
	        [
		        'attribute' => 'client_id',
		        'format' => 'raw',
		        'value' => function($model)
		        {
			        $arr = \app\models\Client::getUserInfo($model->client_id);
			        $echo = $arr['title'].$arr['legal_name'];
			        return Html::a($echo, \yii\helpers\Url::toRoute(['client/update', 'id' => $model->client_id]));
		        },
		        'filter' => Html::activeDropDownList(
			        $searchModel,
			        'client_id',
			        \app\models\Client::getClientsForDropDownList(),
			        [
				        'prompt' => Yii::t('app', 'Choose')
			        ])
	        ],
	        [
		        'attribute' => 'car_id',
		        'value' => function($model) {
			        return \app\models\Car::getCarById($model->car_id);
		        },
		        'filter' => Html::activeDropDownList(
			        $searchModel,
			        'car_id',
			        \app\models\Car::getCarsForDropDownList(),
			        [
				        'prompt' => Yii::t('app', 'Choose')
			        ])
	        ],
	        [
		        'attribute' => 'driver_id',
		        'value' => function($model){
			        return \app\models\Driver::findOne($model->driver_id)['name'];
		        },
		        'filter' => Html::activeDropDownList(
			        $searchModel,
			        'driver_id',
			        \app\models\Driver::getDriversForDropdownList(),
			        [
				        'prompt' => Yii::t('app', 'Choose')
			        ]),
		        'contentOptions'=>['style'=>'max-width: 50px;']
	        ],
//            'date_create',
//            'date_update',
	        [
		        'attribute' => 'datetime_booking',
		        'value' => function($model){
			        return date('d.m.Y H:i', strtotime($model->datetime_booking));
		        }
	        ],
	        [
		        'attribute' => 'from_point_id',
		        'value' => function($model)
		        {
			        return \app\models\Transfer::getPointById($model->from_point_id);
		        },
		        'filter' => Html::activeDropDownList(
			        $searchModel,
			        'from_point_id',
			        \app\models\Transfer::getPointsForDropDownList(),
			        [
				        'prompt' => Yii::t('app', 'Choose')
			        ])
	        ],
	        [
		        'attribute' => 'to_point_id',
		        'value' => function($model)
		        {
			        return \app\models\Transfer::getPointById($model->to_point_id);
		        },
		        'filter' => Html::activeDropDownList(
			        $searchModel,
			        'to_point_id',
			        \app\models\Transfer::getPointsForDropDownList(),
			        [
				        'prompt' => Yii::t('app', 'Choose')
			        ])
	        ],
	        [
		        'attribute' => 'tariff_id',
		        'value' => function($model){
			        return \app\models\Tariff::findOne(['id' => $model->tariff_id])['name'];
		        },
		        'filter' => Html::activeDropDownList(
				    $searchModel,
				    'tariff_id',
				    \app\models\Tariff::getTariffForDropDownList(),
				    [
					    'prompt' => Yii::t('app', 'Choose')
				    ])
	        ],
	        [
		        'attribute' => 'status_id',
		        'value' => function($model){
			        return \app\models\Status::getStatusById($model->status_id);
		        },
		        'filter' => Html::activeDropDownList(
			        $searchModel,
			        'status_id',
			        \app\models\Status::getStatusListForDropDownList(),
			        [
				        'prompt' => Yii::t('app', 'Choose')
			        ])
	        ],
            // 'text_table',
            // 'car_class_id',

            //
            // 'passengers',
            // 'comment',

            [
	            'class' => 'yii\grid\ActionColumn',
	            'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
</div>
