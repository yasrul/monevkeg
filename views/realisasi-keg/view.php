<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RealisasiKeg */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Realisasi Kegs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="realisasi-keg-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'Tahun',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Unit',
            'Kd_Sub',
            'Kd_Prog',
            'ID_Prog',
            'Kd_Keg',
            'Kd_Indikator',
            'No_ID',
            'Tolak_Ukur',
            'Target_Angka',
            'Target_Uraian',
            'Real_Keu',
            'Real_Fisik',
        ],
    ]) ?>

</div>
