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
        $realBidangs = (new Query())->select('u.unit_kerja AS Unit_Kerja, SUM(r.fisik)/COUNT(i.Kd_Prog) AS rerata_fisik, SUM(r.keuangan)/COUNT(i.Kd_Prog) rerata_uang')
                ->from('indikator i')
                ->leftJoin('(SELECT id_indikator, MAX(fisik) AS fisik, MAX(keuangan) AS keuangan FROM realisasi GROUP BY id_indikator) r ON i.id = r.id_indikator')
                ->leftJoin('(SELECT pu.Kd_Urusan, pu.Kd_Bidang, pu.Kd_Unit, pu.Kd_Sub, pu.Kd_Prog, pu.Kd_Keg, uk.unit_kerja FROM program_unit pu LEFT JOIN unit_kerja uk ON uk.id = pu.ID_UnitKerja) u ON (u.Kd_Urusan = i.Kd_Urusan AND u.Kd_Bidang = i.Kd_Bidang AND u.Kd_Unit = i.Kd_Unit AND u.Kd_Prog = i.Kd_Prog AND u.Kd_Keg = i.Kd_Keg)')
                ->groupBy('u.unit_kerja')->orderBy('u.unit_kerja')
                ->all();
        
        $dataProvider = new ArrayDataProvider([
            'allModels' => $realBidangs,
        ]);
        
        $series = [];
        $categories = [];
        $fisik = [];
        $uang = [];
        foreach ($realBidangs as $realBidang) {
            $categories[] = $realBidang['Unit_Kerja'];
            $fisik[] = round($realBidang['rerata_fisik'], 2);
            $uang[] = round($realBidang['rerata_uang'],2);
            
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
