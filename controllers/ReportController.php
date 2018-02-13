<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
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
            'access' => [
                'class'=> AccessControl::className(),
                'only'=>['lap-monev','export-pdf'],
                'rules'=>[
                    [
                        'actions'=>['lap-monev','export-pdf',],
                        'allow'=>TRUE,
                        'roles'=>['@'],
                    ]
                    
                ],
                'denyCallback'=> function ($rule, $action) {
                    throw new \yii\web\ForbiddenHttpException('Anda tidak diizinkan untuk mengakses halaman '.$action->id.' ini');
                }
            ],
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
        
        $model->addRule(['tahun'], 'required');
        $model->addRule(['tahun','kd_prog'], 'integer');       
        $model->attributes(['tahun' => 'Tahun', 'kd_prog' => 'Program']);
        
        $model->load(Yii::$app->request->queryParams);
        
        $allModel = $this->getMonevKeg ($model);
        
        $dataProvider = new ArrayDataProvider([
            'allModels' => $allModel
        ]);
        
        return $this->render('lap-monev',['model' => $model,'dataProvider' => $dataProvider]);
    }
    
    public function actionExportPdf($params = null) {
        
        $allModel = $this->getMonevKeg($params);
        
        $dataProvider = new ArrayDataProvider([
            'allModels' => $allModel,
            'pagination'=> [
                'pageSize'=>FALSE,
            ]
        ]);
        
        $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
        //set template
        $template = Yii::getAlias('@app/views/report').'/_monevkeg.xlsx';
        $objPHPExcel = $objReader->load($template);
        $activeSheet = $objPHPExcel->getActiveSheet();
        // set orientasi dan ukuran kertas
        $activeSheet->getPageSetup()
                ->setOrientation(\PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE)
                ->setPaperSize(\PHPExcel_Worksheet_PageSetup::PAPERSIZE_FOLIO);
        
        $baseRow=3;
        foreach ($dataProvider->getModels() as $absen) {
            $activeSheet->setCellValue('A'.$baseRow, $baseRow-2)
                    ->setCellValue('B'.$baseRow, (int)$absen['badgenumber'])
                    ->setCellValue('C'.$baseRow, $absen['name'])
                    ->setCellValue('D'.$baseRow, $absen['datang'])
                    ->setCellValue('E'.$baseRow, $absen['pulang'])
                    ->setCellValue('F'.$baseRow, $absen['keterangan']);
            $baseRow++;
        }
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="_monevkeg.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
        $objWriter->save('php://output');
        exit;
        
        return TRUE;
    }
    
    public function getMonevKeg ($params) {
        $allModel = (new Query())->select(['i.Kd_Urusan','i.Kd_Bidang','i.Kd_Unit','i.Kd_Sub','i.Kd_Prog','i.Kd_Keg',
            'p.Ket_Program','k.Ket_Kegiatan','i.Tolak_Ukur','CONCAT(CAST(FORMAT(i.Target_Angka,0) as CHARACTER)," ",i.Target_Uraian) as Target',
            'r.keuangan', 'r.fisik', 'm.kinerja', 'm.permasalahan', 'm.resume', 'm.rekomendasi'])
                ->from('indikator i')
                ->andWhere(['i.Tahun'=>$params['tahun']])
                ->andFilterWhere(['i.Kd_Prog' => $params['kd_prog']])
                ->leftJoin('program p ON (i.Kd_Prog = p.Kd_Prog) AND (i.ID_Prog = p.ID_Prog)')
                ->leftJoin('kegiatan k ON (i.Kd_Prog = k.Kd_Prog) AND (i.ID_Prog = k.Id_Prog) AND (i.Kd_Keg = k.Kd_Keg)')
                ->leftJoin('(SELECT id_indikator, MAX(fisik) AS fisik, MAX(keuangan) AS keuangan FROM realisasi GROUP BY id_indikator) r ON (i.id = r.id_indikator)')
                ->leftJoin('monev m ON (i.id = m.id_indikator)')               
                ->all();
        
        return $allModel;
    }
}
