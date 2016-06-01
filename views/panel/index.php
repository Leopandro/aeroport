<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PanelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Стоянка';
$this->params['breadcrumbs'][] = $this->title;
//$car = $model->getCar()->one();
?>
<div class="panel-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Въезд авто', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'car_id',
	        [
		        'attribute' => '',
		        'format' => 'raw',
		        'label' => 'Фото автомобиля',
		        'value' => function($model)
		        {
			        return Html::img(Yii::getAlias('/web/files/images/'.$model->getCar()->one()->image), [
				        'width' => '100px',
				        'height' => '80px'
			        ]);
		        }
	        ],
	        [
		        'attribute' => '',
		        'format' => 'raw',
		        'label' => 'Марка, модель',
		        'value' => function($model)
		        {
			        $car = $model->getCar()->one();
					return
						Html::tag('div', '<b>'.$car->getCarBrand().' '.$car->model.'</b>').
						Html::tag('div', $car->number).
						Html::tag('div', 'Пассажиры: '.$car->number_of_passengers).
						Html::tag('div', 'Багажных мест: '.$car->baggage_count).
						Html::tag('div', 'Кондиционер: '.$car->getConditioner()).
						Html::tag('div', 'Детское кресло: '.$car->getChair());
		        }
	        ],
	        [
		        'attribute' => '',
//		        'format' => 'raw',
		        'label' => 'Уфа(центр)',
		        'value' => function($model)
		        {
			        if ($model->use_new_tariffs)
				        $result =  $model->town_center;
			        else $result = \app\models\DriverTariff::findOne(['id' => $model->driver_id])->town_center;
			        if (!$result)
				        $result = '-';
			        return $result;
		        }
	        ],
	        [
		        'attribute' => '',
		        'format' => 'raw',
		        'label' => 'Уфа',
		        'value' => function($model)
		        {
			        if ($model->use_new_tariffs)
				        $result =  $model->town;
			        else $result = \app\models\DriverTariff::findOne(['id' => $model->driver_id])->town;
			        if (!$result)
				        $result = '-';
			        return $result;
		        }
	        ],
	        [
		        'attribute' => '',
		        'format' => 'raw',
		        'label' => 'Межгород',
		        'value' => function($model)
		        {
			        if ($model->use_new_tariffs)
				        $result =  $model->km_price;
			        else $result = \app\models\DriverTariff::findOne(['id' => $model->driver_id])->km_price;
			        if (!$result)
				        return $result = '-';
			        return $result.' руб./км';
		        }
	        ],
			[
				'attribute' => '',
				'format' => 'raw',
				'label' => 'Осталось времени(в ч.):',
				'value' => function($model)
				{
					return ceil((($model->date_update + $model->station_time * 3600) - time())/3600);
				}
			],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
