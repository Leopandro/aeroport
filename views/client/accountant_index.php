<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Clients');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			'username',
			[
				'attribute' => 'role_id',
				'value' => function($model){
					return $model->role->title;
				}
			],
//            'email:email',
			'user_info.title',
			'user_info.legal_name',
			'user_info.inn',
			'user_info.responsible',
			'email',
			'user_info.contact_number',
//            'password_hash',
//            'auth_key',
			// 'confirmed_at',
			// 'unconfirmed_email:email',
			// 'blocked_at',
			// 'registration_ip',
			// 'created_at',
			// 'updated_at',
			// 'flags',
			// 'admin_id',
		],
	]); ?>
</div>
