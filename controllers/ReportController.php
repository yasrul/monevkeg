<?php

namespace app\controllers;

use yii\web\Controller;

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
        
    }
}
