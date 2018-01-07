<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Monev */

$this->title = 'Create Monev';
//$this->params['breadcrumbs'][] = ['label' => 'Monevs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Realisasi Keg', 'url' => ['realisasi-keg/view', 'id'=>$model->id_indikator]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="monev-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
