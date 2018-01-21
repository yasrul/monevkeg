<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\models\Program;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\RealisasiKegSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Realisasi Kegiatan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="realisasi-keg-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <!--<?= Html::a('Create Realisasi Keg', ['create'], ['class' => 'btn btn-success']) ?>-->
    </p>
    <div class="form">
        <?php $form = ActiveForm::begin([
            'action' => ['realisasi-keg/index'],
            'method' => 'get'
        ]); ?>
        <?= $form->field($searchModel, 'Tahun')->dropDownList(['2017'=>'2017','2018'=>'2018'], [
            'prompt' => '[Tahun Anggaran]',
            'style' => 'width:200px'
        ]) ?>
        <?= $form->field($searchModel, 'Kd_Prog')->dropDownList(Program::listProgram(),[
            'prompt' =>'[Program]',
            'style' => 'width:500px'
        ]) ?>
        
        <div class="form-group">
            <?= Html::submitButton('Filter', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
        
    </div>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'Tahun',
            //['attribute' => 'program', 'value' => 'program.Ket_Program'],
            ['attribute' => 'kegiatan', 'value' => 'kegiatan.Ket_Kegiatan'],
            // 'Kd_Indikator',
            // 'No_ID',
            'Tolak_Ukur',
            'Target_Angka',
            'Target_Uraian',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
        ],
    ]); ?>
</div>
