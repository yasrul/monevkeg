<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Realisasi */

$this->title = 'Update Realisasi: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Realisasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="realisasi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
