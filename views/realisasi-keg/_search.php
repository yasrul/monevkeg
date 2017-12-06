<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\RealisasiKegSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="realisasi-keg-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'Tahun') ?>

    <?= $form->field($model, 'Kd_Urusan') ?>

    <?= $form->field($model, 'Kd_Bidang') ?>

    <?= $form->field($model, 'Kd_Unit') ?>

    <?php // echo $form->field($model, 'Kd_Sub') ?>

    <?php // echo $form->field($model, 'Kd_Prog') ?>

    <?php // echo $form->field($model, 'ID_Prog') ?>

    <?php // echo $form->field($model, 'Kd_Keg') ?>

    <?php // echo $form->field($model, 'Kd_Indikator') ?>

    <?php // echo $form->field($model, 'No_ID') ?>

    <?php // echo $form->field($model, 'Tolak_Ukur') ?>

    <?php // echo $form->field($model, 'Target_Angka') ?>

    <?php // echo $form->field($model, 'Target_Uraian') ?>

    <?php // echo $form->field($model, 'Real_Keu') ?>

    <?php // echo $form->field($model, 'Real_Fisik') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
