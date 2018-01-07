<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Realisasi */

$this->title = 'Create Realisasi';
//$this->params['breadcrumbs'][] = ['label' => 'Realisasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Realisasi Kegs', 'url' => ['realisasi-keg/view', 'id'=>$model->id_indikator]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="realisasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
