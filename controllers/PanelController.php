<?php

namespace app\controllers;

use app\models\CarTariff;
use Yii;
use app\models\Panel;
use app\models\PanelSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PanelController implements the CRUD actions for Panel model.
 */
class PanelController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Panel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PanelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Panel model.
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
     * Creates a new Panel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Panel();

        if ($model->load(Yii::$app->request->post())) {
	        $model->date_create = time();
	        $model->date_update = time();
	        if ($model->save())
                return $this->redirect('/panel/index');
	        else
		        return $this->render('create', [
			        'model' => $model,
		        ]);
        } else {
	        !$model->station_time ? $model->station_time = 48 : null;
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

	public function actionGetCarsTariff()
	{
		if (Yii::$app->request->isAjax)
		{
			$id = $_POST['id'];
			$model = CarTariff::findOne(['id' => $id]);
			\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			$model = json_encode($model->attributes);
			return $model;
		}
	}

    /**
     * Updates an existing Panel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

	    if ($model->load(Yii::$app->request->post())) {
		    $model->date_update = time();
		    if ($model->save())
			    return $this->redirect('/panel/index');
		    else
			    return $this->render('create', [
				    'model' => $model,
			    ]);
	    } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Panel model.
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
     * Finds the Panel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Panel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Panel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
