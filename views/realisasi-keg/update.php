<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RealisasiKeg */

$this->title = 'Update Realisasi Keg: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Realisasi Kegs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="realisasi-keg-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
