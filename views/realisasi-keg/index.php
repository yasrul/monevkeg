<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'Tahun',
            ['attribute' => 'program', 'value' => 'program.Ket_Program'],
            ['attribute' => 'kegiatan', 'value' => 'kegiatan.Ket_Kegiatan'],
            // 'Kd_Indikator',
            // 'No_ID',
            'Tolak_Ukur',
            'Target_Angka',
            'Target_Uraian',
            'Real_Keu',
            'Real_Fisik',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
