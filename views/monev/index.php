<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\MonevSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Monev';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="monev-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Monev', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_indikator',
            'tgl_keg',
            'kinerja',
            'permasalahan',
            // 'resume',
            // 'rekomendasi',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
