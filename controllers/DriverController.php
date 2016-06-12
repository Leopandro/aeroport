<?php

namespace app\controllers;

use app\models\Car;
use app\models\DriverCar;
use dektrium\user\filters\AccessRule;
use Yii;
use app\models\Driver;
use app\models\DriverSearch;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
/**
 * DriverController implements the CRUD actions for Driver model.
 */
class DriverController extends Controller
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
						'matchCallback' => function(){
							return (Yii::$app->user->identity->role_id == \app\models\User::ROLE_ADMIN);
						}
					],
				],
			],
		];
	}

    /**
     * Lists all Driver models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DriverSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Driver model.
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
     * Creates a new Driver model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Driver();
        if ($model->load(Yii::$app->request->post())) {
	        if ($model->save())
	        {
		        return $this->redirect('index');
	        }
        } else {
            return $this->render('create', [
                'model' => $model,
//	            'modelDriverCar' => $modelDriverCar
            ]);
        }
    }

    /**
     * Updates an existing Driver model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
	        if ($model->save())
	        {
		        return $this->redirect('index');
	        }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Driver model.
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
     * Finds the Driver model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Driver the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Driver::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

	public function actionGetDropDownDrivers()
	{
		if (Yii::$app->request->isAjax)
		{
			$id = $_POST['id'];
			$car = Car::findOne(['id' => $id]);
			$result = $car->getDrivers();
			$arr = [];
			if ($result)
			{
				foreach ($result as $key => $item)
				{
					$arr[$key] = $item['name'].' '.$item['surname'];
				}
			}
			$return = Html::dropDownList('drop', null, $arr);
//			$return = '<option value="">Выберите авто</option>';
//			foreach ($result as $key => $item)
//			{
//				if ($driver->car_id == $key)
//				{
//					$return .= '<option value='.$key.' selected>'.$item.'</option>';
//				}
//				else
//					$return .= '<option value='.$key.'>'.$item.'</option>';
//			}
			\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return $return;
		}
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return [];
	}
}
