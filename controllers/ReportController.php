<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\base\DynamicModel;
use yii\db\Query;
use yii\data\ArrayDataProvider;

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
        $model = new DynamicModel(['tahun','kd_prog']);
        
        $model->addRule(['tahun','kd_prog'], 'required');
        $model->addRule(['tahun','kd_prog'], 'integer');       
        $model->attributes(['tahun' => 'Tahun', 'kd_prog' => 'Program']);
        
        $model->load(Yii::$app->request->queryParams);
        
        $realKeg = (new Query())->select(['CONCAT(i.Kd_Urusan,".",i.Kd_Bidang,".",i.Kd_Unit,".",i.Kd_Sub,".",i.Kd_Prog,".",i.Kd_Keg) AS Kode',
            'p.Ket_Program','k.Ket_Kegiatan','i.Tolak_Ukur','CONCAT(CAST(FORMAT(i.Target_Angka,0) as CHARACTER)," ",i.Target_Uraian) as Target',
            'r.keuangan', 'r.fisik', 'm.kinerja', 'm.permasalahan', 'm.resume', 'm.rekomendasi'])
                ->from('indikator i')
                ->leftJoin('program p ON (i.Kd_Prog = p.Kd_Prog) AND (i.ID_Prog = p.ID_Prog)')
                ->leftJoin('kegiatan k ON (i.Kd_Prog = k.Kd_Prog) AND (i.ID_Prog = k.Id_Prog) AND (i.Kd_Keg = k.Kd_Keg)')
                ->leftJoin('(SELECT id_indikator, MAX(fisik) AS fisik, MAX(keuangan) AS keuangan FROM realisasi GROUP BY id_indikator) r ON i.id = r.id_indikator')
                ->leftJoin('monev m ON i.id = m.id_indikator')
                ->all();
        
        $dataProvider = new ArrayDataProvider([
            'allModels' => $realKeg
        ]);
        
        return $this->render('lap-monev',['model' => $model,'dataProvider' => $dataProvider]);
    }
}
