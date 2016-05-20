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

    <p>
        <?= Html::a(Yii::t('app', 'Create Client'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'username',
	        'email',
	        [
		        'attribute' => 'role_id',
		        'value' => function($model){
			        return $model->role->title;
		        }
	        ],
//            'email:email',
	        'user_info.title',
	        'user_info.legal_name',
	        [
		        'attribute' => 'user_info.inn'
	        ],
	        'user_info.responsible',
	        'user_info.balance',
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

	        [
		        'class' => 'yii\grid\ActionColumn',
		        'template' => '{update}, {delete}'
	        ],
        ],
    ]); ?>
<!--	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Пополнить счет</button>-->
<!--	<div id="myModal" class="modal fade" role="dialog">-->
<!--		<div class="modal-dialog">-->
<!--			<div class="modal-content">-->
<!--				<div class="modal-header">-->
<!--					Пополнить счет-->
<!--				</div>-->
<!--				<div class="modal-body">-->
<!--					<input type="text" class="form-control">-->
<!--				</div>-->
<!--				<div class="modal-footer">-->
<!--					<button type="submit" class="btn btn-primary">Принять</button>-->
<!--					<button type="button" class="btn btn-danger" data-dismiss="modal">Отмена</button>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
</div>
