<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\grid\GridView;

use app\models\Program;

/* @var $this yii\web\View */
/* @var $dataProvider app\controllers\ReportController */
/* @var $model app\controllers\ReportController */


$this->title = 'Laporan Monev Kegiatan';
$this->params['breadcrumbs'][] = $this->title;

?>
<h1>LAPORAN MONEV KEGIATAN</h1>
<div class="form">
    <?php $form = ActiveForm::begin([
        'action' => ['report/lap-monev'],
        'method' => 'get'
    ]);?>
    <?= $form->field($model, 'tahun')->dropDownList(['2017'=>'2017', '2018'=>'2018'], [
        'prompt' => '[Tahun Anggaran]',
        'style' => 'width:200px',
    ]); ?>
    <?= $form->field($model, 'kd_prog')->dropDownList(Program::listProgram(), [
        'prompt' => '[ Semua Program ]',
        'style' => 'width:500px'
    ]); ?>
    
    <div class="form-group">
        <?= Html::submitButton('Tampilkan', ['class' => 'btn btn-primary']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'beforeHeader' => [
            [
                'columns' => [
                    ['content' => 'KEGIATAN', 'options' => ['colspan'=>5, 'class'=>'text-center warning']],
                    ['content' => 'REALISASI', 'options' => ['colspan'=>3, 'class'=>'text-center warning']],
                    ['content' => 'EVALUASI', 'options' => ['colspan'=>3, 'class'=>'text-center warning']],
                ]
            ]
        ],
        'columns' => [
            ['class' =>'kartik\grid\SerialColumn'],
            [
                'label' => 'Kode',
                //'group' => TRUE,
                'value' => function ($data) {
                    return $data['Kd_Urusan'].'.'.$data['Kd_Bidang'].'.'.$data['Kd_Unit'].'.'.$data['Kd_Sub'].
                            '.'.$data['Kd_Prog'].'.'.$data['Kd_Keg'];
                }
            ],    
            [
                'attribute'=>'Ket_Program',
                'label'=>'Program',
                'group'=>TRUE,
                'groupedRow'=>TRUE,
                'value'=> function ($data) {
                    return $data['Kd_Urusan'].'.'.$data['Kd_Bidang'].'.'.$data['Kd_Unit'].'.'.$data['Kd_Sub'].
                            '.'.$data['Kd_Prog'].' '.$data['Ket_Program'];
                }
            ],
            [
                'attribute'=>'Ket_Kegiatan',
                'label'=>'Kegiatan',
                //'group'=>TRUE
            ],
            ['attribute'=>'Tolak_Ukur', 'label'=>'Indikator'],
            'Target',
            ['attribute'=>'keuangan', 'label'=>'Keu'] ,
            'fisik',
            'kinerja',
            ['attribute'=>'permasalahan', 'format'=>'raw','label'=>'Permasalahan'],
            ['attribute'=>'resume', 'format'=>'raw'],
            ['attribute' => 'rekomendasi', 'format' => 'raw']
            
        ]
    ]); ?>
    
    <?= Html::a('Export Excel', ['export-excel', 'model' => $model], ['class'=>'btn btn-info']); ?>&nbsp;
    <?= Html::a('Export PDF', ['report/export-pdf', 'params' => $model], ['class'=>'btn btn-info']); ?>  
    
</div>

