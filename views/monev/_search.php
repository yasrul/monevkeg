<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\MonevSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="monev-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_indikator') ?>

    <?= $form->field($model, 'tgl_keg') ?>

    <?= $form->field($model, 'kinerja') ?>

    <?= $form->field($model, 'pemasalahan') ?>

    <?php // echo $form->field($model, 'resume') ?>

    <?php // echo $form->field($model, 'rekomendasi') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
