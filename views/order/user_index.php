<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
				'attribute' => 'car_id',
				'value' => function($model){
					return \app\models\Car::getCarById($model->car_id);
				}
			],
			[
				'attribute' => 'driver_id',
				'value' => function($model){
					return \app\models\Driver::findOne($model->driver_id)['name'];
				}
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
						'prompt' => Yii::t('app', 'Choose point')
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
						'prompt' => Yii::t('app', 'Choose point')
					])
			],
			[
				'attribute' => 'tariff_id',
				'value' => function($model){
					return \app\models\Tariff::findOne(['id' => $model->tariff_id])['name'];
				}
			],
			[
				'attribute' => 'status_id',
				'value' => function($model){
					return \app\models\Status::getStatusById($model->status_id);
				}
			],
			// 'text_table',
			// 'car_class_id',
			// 'car_id',
			// 'tariff_id',
			// 'passengers',
			// 'comment',

			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update}',
				'visibleButtons' => [
					'update' => function($model){
						if ($model->status_id == 1)
							return true;
						if ($model->status_id == 4 || $model->status_id == 5)
							return false;
					}
				]
			],
		],
	]); ?>
</div>
