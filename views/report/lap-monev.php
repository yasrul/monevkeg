<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\grid\GridView;

use app\models\Program;

/* @var $this yii\web\View */
/* @var $dataProvider app\controllers\ReportController */


$this->title = 'Laporan Monev Kegiatan';
$this->params['breadcrumbs'][] = $this->title;

?>
<h1>LAPORAN MONEV KEGIATAN</h1>
<div class="form">
    <?php $form = ActiveForm::begin([
        'action' => 'report/lap-monev',
        'method' => 'get'
    ]);?>
    <?= $form->field($model, 'tahun')->dropDownList(['2017'=>'2017', '2018'=>'2018'], [
        'prompt' => '[Tahun Anggaran]',
        'style' => 'width:200px',
    ]) ?>;
    <?= $form->field($model, 'kd_prog')->dropDownList(Program::listProgram(), [
        'prompt' => '[PROGRAM]',
        'style' => 'width:500px'
    ]); ?>
    
    <div class="form-group">
        <?= Html::submitButton('Filter', ['class' => 'btn btn-primary']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' =>'kartik\grid\SerialColumn'],
            [
                'attribute' => 'Kode'
            ]
        ]
    ]); ?>
    
</div>

