<?php

namespace app\controllers;

use dektrium\user\filters\AccessRule;
use app\models\User;
use Yii;
use app\models\Order;
use app\models\OrderSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    /**
     * @inheritdoc
     */
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete'  => ['post'],
					'confirm' => ['post'],
					'block'   => ['post'],
				],
			],
			'access' => [
				'class' => AccessControl::className(),
				'ruleConfig' => [
					'class' => AccessRule::className(),
				],
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@'],
						'actions' => [
							'index',
							'create',
							'update'
						],
						'matchCallback' => function(){
							return in_array(Yii::$app->user->identity->role_id, [
								User::ROLE_ADMIN,
								User::ROLE_MANAGER,
								User::ROLE_ACCOUNTANT,
								User::LEGAL_ENTITY,
								User::INDIVIDUAL,
							]);
						}
					],
					[
						'allow' => true,
						'roles' => ['@'],
						'actions' => [
							'delete'
						],
						'matchCallback' => function(){
							return in_array(Yii::$app->user->identity->role_id, [
								User::ROLE_ADMIN
							]);
						}
					],
				],
			],
		];
	}

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
		$user = Yii::$app->user->identity;
	    if (Yii::$app->user->identity->role_id == 6 || Yii::$app->user->identity->role_id == 2)
	    {
		    $search = array_merge(Yii::$app->request->queryParams, [
			    'client_id' => Yii::$app->user->identity->getId()
		    ]);
		    $dataProvider = $searchModel->search($search);
		    return $this->render('user_index', [
			    'searchModel' => $searchModel,
			    'dataProvider' => $dataProvider,
		    ]);
	    }
	    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();
	    $model->loadAddress();
        if ($model->load(Yii::$app->request->post()) && $model->address->load(Yii::$app->request->post())) {
	        $datetime = date('Y-m-d H:i:s', strtotime("$model->datetime_booking $model->time"));
	        $model->datetime_booking = $datetime;
	        $model->status_id = 1;
	        $model->client_id = Yii::$app->user->identity->getId();
	        if ($model->save())
	        {
		        return $this->redirect(['order/index']);
	        }
        } else {
	        $model->datetime_booking ? $model->datetime_booking = date('d.m.Y', strtotime($model->datetime_booking)) : null;
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
	    if (Yii::$app->user->identity->role_id == User::ROLE_ADMIN || Yii::$app->user->identity->role_id == User::ROLE_MANAGER)
		    $model->scenario = 'purpose';
	    $model->loadAddress();

        if ($model->load(Yii::$app->request->post()) && $model->address->load(Yii::$app->request->post())) {
	        $datetime = date('Y-m-d H:i:s', strtotime("$model->datetime_booking $model->time"));
	        $model->datetime_booking = $datetime;
	        if ($model->save())
	        {
		        return $this->redirect(['order/index']);
	        }
        } else {
	        $model->datetime_booking = date('d.m.Y', strtotime($model->datetime_booking));

	        return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
