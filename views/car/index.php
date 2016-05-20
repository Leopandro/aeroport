<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cars');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Car'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
	        [
		        'attribute' => 'company',
		        'value' => function($model){
			        return \app\models\CarBrand::getCarBrandById($model->company);
		        }
	        ],
            'model',
	        [
		        'attribute' => 'class',
		        'value' => function($model){
			        return \app\models\Car::getClassById($model->class);
		        }
	        ],
            'year',
             'number',
	        [
		        'attribute' => 'color',
	        ],
             'number_of_passengers',

	        [
		        'class' => 'yii\grid\ActionColumn',
		        'template' => '{update}, {delete}'
	        ],
        ],
    ]); ?>
</div>
