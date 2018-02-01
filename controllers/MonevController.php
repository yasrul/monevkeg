<?php

namespace app\controllers;

use Yii;
use app\models\Monev;
use app\models\search\MonevSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

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
                    $path = Yii::getAlias('@app/docfiles/').$filename;
                    $count = 0;
                    while (file_exists($path)) {
                        $count++;
                        $filename = $fileup->baseName.'_'.$count.'.'.$fileup->extension;
                        $path = Yii::getAlias('@app/docfiles/').$filename;                      
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
        if (isset($model->dokumen)) {
            $dokumens = explode("//", $model->dokumen);
            $urlfiles = [];
            for ($i=0; $i < count($dokumens)-1; $i++) {
                $urlfiles[] = Yii::$app->getUrlManager()->getBaseUrl().'/docfiles/'.$dokumens[$i];
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            $filesup = UploadedFile::getInstances($model, 'filesup');
            if ($filesup) {
                $dokumen = $model->dokumen;
                foreach ($filesup as $fileup) {
                    $filename = $fileup->name;
                    $path = Yii::getAlias('@app/docfiles/').$filename;
                    $count = 0;
                    while (file_exists($path)) {
                        $count++;
                        $filename = $fileup->baseName.'_'.$count.'.'.$fileup->extension;
                        $path = Yii::getAlias('@app/docfiles/').$filename;                      
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
