<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use yii\db\Query;

use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RealisasiKeg;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $realProgs = (new Query())->select('p.Ket_Program AS Program, SUM(r.fisik)/COUNT(i.Kd_Prog) AS rerata_fisik, SUM(r.keuangan)/COUNT(i.Kd_Prog) rerata_uang')
                ->from('indikator i')
                ->leftJoin('(SELECT id_indikator, MAX(fisik) AS fisik, MAX(keuangan) AS keuangan FROM realisasi GROUP BY id_indikator) r ON i.id = r.id_indikator')
                ->leftJoin('program p ON (i.Kd_Prog = p.Kd_Prog)')
                ->groupBy('i.Kd_Prog')->orderBy('i.Kd_Prog')
                ->all();
        
        $dataProvider = new ArrayDataProvider([
            'allModels' => $realProgs,
        ]);
        
        $series = [];
        $categories = [];
        $fisik = [];
        $uang = [];
        foreach ($realProgs as $realProg) {
            $categories[] = $realProg['Program'];
            $fisik[] = round($realProg['rerata_fisik'], 2);
            $uang[] = round($realProg['rerata_uang'],2);
            
        }
        
        $series = [
                ['name' => 'Fisik', 'data' => $fisik],
                ['name' => 'Uang', 'data' => $uang]
        ];
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'categories'=>$categories,
            'series' => $series
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
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

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
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

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
