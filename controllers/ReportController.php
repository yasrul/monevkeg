<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\db\Query;
use yii\data\ArrayDataProvider;

use app\models\ReportForm;
use app\models\PermissionHelpers;
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
                'only'=>['lap-monev','export-excel'],
                'rules'=>[
                    [
                        'actions'=>['lap-monev','export-excel',],
                        'allow'=>TRUE,
                        'roles'=>['@'],
                        'matchCallback' => function ($rule, $action) {
                            return PermissionHelpers::requireMinimumRole('operator') &&
                            PermissionHelpers::requireStatus('Active');
                        }
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
        
        $model = new ReportForm();
        $model->load(Yii::$app->request->queryParams);
        
        $allModel = $this->getMonevKeg ($model);
        
        $dataProvider = new ArrayDataProvider([
            'allModels' => $allModel
        ]);
        
        return $this->render('lap-monev',['model' => $model,'dataProvider' => $dataProvider]);
    }
    
    public function actionExportExcel(array $params) {
        
        $allModel = $this->getMonevKeg($params);
        
        $dataProvider = new ArrayDataProvider([
            'allModels' => $allModel,
            'pagination'=> [
                'pageSize'=>FALSE,
            ]
        ]);
        
        $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
        $objRichText = new \PHPExcel_Helper_HTML();
        //set template
        $template = Yii::getAlias('@app/views/report').'/_monevkeg.xlsx';
        $objPHPExcel = $objReader->load($template);
        $activeSheet = $objPHPExcel->getActiveSheet();
        // set orientasi dan ukuran kertas
        $activeSheet->getPageSetup()
                ->setOrientation(\PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE)
                ->setPaperSize(\PHPExcel_Worksheet_PageSetup::PAPERSIZE_FOLIO);
        
        $baseRow=3;
        foreach ($dataProvider->getModels() as $monev) {
            $activeSheet->setCellValue('A'.$baseRow, $baseRow-2)
                    ->setCellValue('B'.$baseRow, $monev['Kd_Urusan'].'.'.$monev['Kd_Bidang'].'.'.$monev['Kd_Unit'].'.'.$monev['Kd_Sub'])
                    ->setCellValue('C'.$baseRow, $monev['Ket_Kegiatan'])
                    ->setCellValue('D'.$baseRow, $monev['Tolak_Ukur'])
                    ->setCellValue('E'.$baseRow, $monev['Target'])
                    ->setCellValue('F'.$baseRow, $monev['keuangan'])
                    ->setCellValue('G'.$baseRow, $monev['fisik'])
                    ->setCellValue('H'.$baseRow, $monev['kinerja'])
                    ->setCellValue('I'.$baseRow, $monev['permasalahan'])
                    ->setCellValue('J'.$baseRow, $monev['resume'])
                    ->setCellValue('K'.$baseRow, $objRichText->toRichTextObject($monev['rekomendasi']));
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
    
    public function getMonevKeg ($params = []) {
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
