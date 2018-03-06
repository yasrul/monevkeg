<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\UploadedFile;

use app\models\PermissionHelpers;
use app\models\Monev;
use app\models\search\MonevSearch;

/**
 * MonevController implements the CRUD actions for Monev model.
 */
class MonevController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class'=> AccessControl::className(),
                'only'=>['index','view','update','delete','create'],
                'rules'=>[
                    [
                        'actions'=>['index','view','update','delete','create'],
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

    /**
     * Lists all Monev models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MonevSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Monev model.
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
     * Creates a new Monev model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idIndikator)
    {
        $model = new Monev();
        $model->id_indikator = $idIndikator;

        if ($model->load(Yii::$app->request->post())) {
            $filesup = UploadedFile::getInstances($model, 'filesup');
            if ($filesup) {
                $dokumen = '';
                foreach ($filesup as $fileup) {
                    $filename = $fileup->name;
                    $path = Yii::$app->basePath.'/web/docfiles/'.$filename;
                    $count = 0;
                    while (file_exists($path)) {
                        $count++;
                        $filename = $fileup->baseName.'_'.$count.'.'.$fileup->extension;
                        $path = Yii::$app->basePath.'/web/docfiles/'.$filename;                      
                    }
                    $dokumen .= $filename.'//';
                    $fileup->saveAs($path);
                }
                $model->dokumen = $dokumen;
            }
            if ($model->save()) {
                return $this->redirect(['realisasi-keg/view', 'id' => $model->id_indikator]);
            }
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Monev model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $previewConfig = [];
        
        if (isset($model->dokumen)) {
            $dokumens = explode("//", $model->dokumen);
            $urlfiles = [];
            for ($i=0; $i < count($dokumens)-1; $i++) {
                $urlfiles[] = Url::toRoute('/docfiles/'.$dokumens[$i]);
                $previewConfig[] = [
                    'caption'=>$dokumens[$i],
                    'url' => Url::to(['monev/delete-file','id' => $model->id,'file'=>$dokumens[$i]]) ,
                ];
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            $filesup = UploadedFile::getInstances($model, 'filesup');
            if ($filesup) {
                $dokumen = $model->dokumen;
                
                foreach ($filesup as $fileup) {
                    $filename = $fileup->name;
                    $path = Yii::$app->basePath.'/web/docfiles/'.$filename;
                    $count = 0;
                    while (file_exists($path)) {
                        $count++;
                        $filename = $fileup->baseName.'_'.$count.'.'.$fileup->extension;
                        $path = Yii::$app->basePath.'/web/docfiles/'.$filename;                      
                    }
                    $dokumen .= $filename."//";
                    $fileup->saveAs($path);
                    
                }
                $model->dokumen = $dokumen;
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }           
        } else {
            return $this->render('update', [
                'model' => $model,
                'urlFiles' => $urlfiles,
                'previewConfig' => $previewConfig,
            ]);
        }
    }

    /**
     * Deletes an existing Monev model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionDeleteFile($id, $file) {
        
        $model = $this->findModel($id);
        $old_dokumens = explode("//", $model->dokumen);
        
        $pathfile = Yii::$app->basePath.'/web/docfiles/'.$file;
        
        if(empty($file) || !file_exists($pathfile)) {
            return FALSE;
        }
        
        if(!unlink($pathfile)) {
            return FALSE;
        }
        $dokumens = '';
        for ($i=0; $i < count($old_dokumens)-1; $i++) {
            if ($old_dokumens[$i]!== $file) {
                $dokumens .= $old_dokumens[$i].'//';
            }
        }
        $model->dokumen = $dokumens;
        if ($model->save()) {        
            return TRUE;
        }
    }

    /**
     * Finds the Monev model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Monev the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Monev::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
