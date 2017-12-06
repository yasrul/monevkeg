<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RealisasiKeg */

$this->title = 'Create Realisasi Keg';
$this->params['breadcrumbs'][] = ['label' => 'Realisasi Kegs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="realisasi-keg-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
