<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\base\DynamicModel;

/**
 * Description of ReportController
 *
 * @author yasrul
 */
class ReportController extends Controller {
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
    
    public function actionLapMonev() {
        $filter = new DynamicModel(['tahun','kd_prog']);
        
        $filter->addRule(['tahun','kd_prog'], 'required');
        $filter->addRule(['tahun','kd_prog'], 'integer');
        
        $filter->attributes(['tahun' => 'Tahun', 'kd_prog' => 'Program']);
        
        $filter->load(Yii::$app->request->queryParams);
        
    }
}
