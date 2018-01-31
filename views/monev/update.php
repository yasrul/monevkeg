<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Monev */

$this->title = 'Update Monev: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Monevs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="monev-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'urlFiles' => $urlFiles,
    ]) ?>

</div>
