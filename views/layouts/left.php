<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><? echo Yii::$app->user->identity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
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
        if (Yii::$app->user->identity->role_id == 1) {
	        echo dmstr\widgets\Menu::widget(
		        [
			        'options' => ['class' => 'sidebar-menu'],
			        'items' => [
				        ['label' => 'Меню', 'options' => ['class' => 'header']],
//				        ['label' => 'Пользователи - сотрудники', 'icon' => 'fa fa-users', 'url' => ['/user/admin/index']],
				        ['label' => 'Водители', 'icon' => 'fa fa-user', 'url' => ['/driver/index']],
//				        ['label' => 'Клиенты', 'icon' => 'fa fa-user', 'url' => ['/client/index']],
//				        ['label' => 'Заказы', 'icon' => 'fa fa-user', 'url' => ['/order/index']],
				        ['label' => 'Автомобили', 'icon' => 'fa fa-car', 'url' => ['/car/index']],
				        ['label' => 'Марки', 'icon' => 'fa fa-car', 'url' => ['/car-brand/index']],
//				        ['label' => 'Трансферы', 'icon' => 'fa fa-code-fork', 'url' => ['/transfer/index']],
//				        ['label' => 'Города', 'icon' => 'fa fa-home', 'url' => ['/town/index']],
//				        ['label' => 'Пункты', 'icon' => 'fa fa-plus-square-o', 'url' => ['/point/index']],
//				        ['label' => 'Тарифы', 'icon' => 'fa fa-dollar', 'url' => ['/tariff/index']],
//				        ['label' => 'Баланс', 'icon' => 'fa fa-dollar', 'url' => ['/payment/index']],
//				        ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest]
			        ],
		        ]
	        );
        }
        elseif(in_array(Yii::$app->user->identity->role_id, [3,5]))
        {
	        echo dmstr\widgets\Menu::widget(
		        [
			        'options' => ['class' => 'sidebar-menu'],
			        'items' => [
				        ['label' => 'Меню', 'options' => ['class' => 'header']],
				        ['label' => 'Заказы', 'icon' => 'fa fa-user', 'url' => ['/order/index']],
			        ]
		        ]
	        );
        }
        elseif(Yii::$app->user->identity->role_id == 4) {
	        echo dmstr\widgets\Menu::widget(
		        [
			        'options' => ['class' => 'sidebar-menu'],
			        'items' => [
				        ['label' => 'Меню', 'options' => ['class' => 'header']],
				        ['label' => 'Клиенты', 'icon' => 'fa fa-user', 'url' => ['/client/index']],
			        ]
		        ]
	        );
        }
        elseif(Yii::$app->user->identity->role_id == 2 || Yii::$app->user->identity->role_id == 6){
	        echo dmstr\widgets\Menu::widget(
		        [
			        'options' => ['class' => 'sidebar-menu'],
			        'items' => [
				        ['label' => 'Меню', 'options' => ['class' => 'header']],
				        ['label' => 'Мои Заказы', 'icon' => 'fa fa-user', 'url' => ['/order/index']],
			        ]
		        ]
	        );
        }
        ?>

    </section>

</aside>
