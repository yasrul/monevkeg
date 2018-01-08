<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\RealisasiKeg */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Realisasi Kegs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="realisasi-keg-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'Tahun',
            ['label' => 'Urusan', 'value' => $model->urusan->Nm_Urusan],
            ['label' => 'Bidang', 'value' => $model->bidang->Nm_Bidang],
            ['label' => 'Unit', 'value' => $model->unit->Nm_Unit],
            'Kd_Sub',
            ['label' => 'Program', 'value' => $model->program->Ket_Program],
            ['label' => 'Kegiatan', 'value' => $model->kegiatan->Ket_Kegiatan],
            //'Kd_Indikator',
            //'No_ID',
            'Tolak_Ukur',
            'Target_Angka',
            'Target_Uraian',
            
        ],
    ]) ?>
    
    <h2>Realisasi</h2>
    <p>
        <?= Html::a('Entry Realisasi', ['realisasi/create', 'idIndikator' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => new yii\data\ActiveDataProvider([
            'query' => $model->getRealisasi(),
            'pagination' => false,
        ]),
        'options' => ['style'=>'width:50%'],
        'columns' => [
            //'tgl_entry',
            ['attribute'=>'tgl_entry', 'contentOptions'=>['style'=>'width:10%']],
            'fisik',
            'keuangan',
            
            ['class' => 'yii\grid\ActionColumn', 
                'template' => '{update} {delete}',
                'controller' => 'realisasi',
            ],
        ]
    ]) ?>
    
    <h2>Kinerja</h2>
    <p>
        <?= Html::a('Entry Kinerja', ['monev/create', 'idIndikator' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => new yii\data\ActiveDataProvider([
            'query' => $model->getMonev(),
            'pagination' => false,
        ]),
        'columns' => [
            //'tgl_keg',
            ['attribute'=>'tgl_keg', 'contentOptions'=>['style'=>'width:10%']],
            'kinerja',
            'permasalahan',
            'resume',
            'rekomendasi',
            
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'controller' => 'monev',
            ],
        ]
    ]) ?>

</div>
