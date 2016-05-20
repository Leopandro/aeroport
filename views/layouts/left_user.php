<aside class="main-sidebar">

	<section class="sidebar">

		<!-- Sidebar user panel -->
		<div class="user-panel" style="height: 130px;">
			<div class="pull-left image">
				<img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
			</div>
			<div class="pull-left info">
				<p><? echo Yii::$app->user->identity->username ?></p>

				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>

				<p style="padding-top: 15px;"><? echo 'Баланс: '.\app\models\UserInfo::findOne(['id' => Yii::$app->user->id])['balance'].' р.'?></p>

<!--				--><?//= \yii\helpers\Html::a('Пополнить счет', \yii\helpers\Url::to('/payment/create'), [
//					'class' => 'btn btn-xs',
//                    'border-color' =>  '#4b646f'
//				])?>
			</div>
		</div>

		<!-- search form -->
		<!--        <form action="#" method="get" class="sidebar-form">-->
		<!--            <div class="input-group">-->
		<!--              <span class="input-group-btn">-->
		<!--                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>-->
		<!--                </button>-->
		<!--              </span>-->
		<!--            </div>-->
		<!--        </form>-->
		<!-- /.search form -->

		<?
			echo dmstr\widgets\Menu::widget(
				[
					'options' => ['class' => 'sidebar-menu'],
					'items' => [
						['label' => 'Меню', 'options' => ['class' => 'header']],
						['label' => 'Заказы', 'icon' => 'fa fa-user', 'url' => ['/order/index']],
						['label' => 'Баланс', 'icon' => 'fa fa-user', 'url' => ['/payment/index']],
					]
				]
			);
		?>

	</section>

</aside>
