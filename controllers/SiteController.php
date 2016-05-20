<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{

	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
		];
	}

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $adminUrl = '/user/admin/index';
        $userUrl = 'order/index';
	    if (!Yii::$app->user->isGuest) {
		    if (Yii::$app->user->identity->role_id == User::ROLE_ADMIN)
            {
                if (Yii::$app->request->isAjax)
                    return Yii::$app->runAction($adminUrl);
                return Yii::$app->runAction($adminUrl);
            }
            elseif(Yii::$app->user->identity->role_id == User::ROLE_ACCOUNTANT)
            {
	            return $this->redirect(Url::toRoute('/client/index'));
            }
		    else
            {
                if (Yii::$app->request->isAjax)
                    return Yii::$app->runAction($userUrl);
                return $this->redirect(Url::toRoute($userUrl));
            }
	    }
	    //return $this->redirect(['catalog/index']);
        //return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
