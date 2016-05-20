<?php

namespace app\controllers;

use app\models\UploadForm;
use app\models\User;
use Yii;
use app\models\Payment;
use app\models\PaymentSearch;
use yii\filters\AccessControl;
use yii\filters\AccessRule;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PaymentController implements the CRUD actions for Payment model.
 */
class PaymentController extends Controller
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
	        'access' => [
		        'class' => AccessControl::className(),
		        'ruleConfig' => [
			        'class' => AccessRule::className(),
		        ],
		        'rules' => [
			        [
				        'allow' => true,
				        'roles' => ['@'],
				        'actions' => ['index', 'create', 'delete', 'update'],
				        'matchCallback' => function(){
					        return (Yii::$app->user->identity->role_id == User::ROLE_ADMIN);
				        }
			        ],
			        [
				        'allow' => true,
				        'roles' => ['@'],
				        'actions' => ['index', 'create'],
				        'matchCallback' => function(){
					        return (in_array(Yii::$app->user->identity->role_id,[
						        User::LEGAL_ENTITY,
						        User::INDIVIDUAL,
					        ]));
				        }
			        ],
		        ],
	        ],
        ];
    }

    /**
     * Lists all Payment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Payment model.
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
     * Creates a new Payment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Payment();
		$uploadModel = new UploadForm();
        if ($model->load(Yii::$app->request->post())) {
	        $model->file = UploadedFile::getInstance($model, 'file');
	        $model->client_id = Yii::$app->user->identity->getId();
			$model->link_pdf = $model->upload();
	        $model->file = null;
	        if ($model->save()) {
		        return $this->redirect(['view', 'id' => $model->id]);
	        }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Payment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
//    public function actionUpdate($id)
//    {
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('update', [
//                'model' => $model,
//            ]);
//        }
//    }

    /**
     * Deletes an existing Payment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
//    public function actionDelete($id)
//    {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }

    /**
     * Finds the Payment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Payment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Payment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
