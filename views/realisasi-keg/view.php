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
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Unit',
            'Kd_Sub',
            ['label' => 'Program', 'value' => $model->program->Ket_Program],
            //'ID_Prog',
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
        <?= Html::a('Entry Realisasi', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => new yii\data\ActiveDataProvider([
            'query' => $model->getRealisasi(),
            'pagination' => false,
        ]),
        'columns' => [
            'tgl_entry',
            'fisik',
            'keuangan',
        ]
    ]) ?>
    
    <h2>Kinerja</h2>
    <p>
        <?= Html::a('Entry Kinerja', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => new yii\data\ActiveDataProvider([
            'query' => $model->getMonev(),
            'pagination' => false,
        ]),
        'columns' => [
            'tgl_keg',
            'kinerja',
            'permasalahan',
            'resume',
            'rekomendasi'
        ]
    ]) ?>

</div>
