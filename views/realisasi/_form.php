<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Realisasi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="realisasi-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--<?= $form->field($model, 'id_indikator')->textInput() ?>-->

    <?= $form->field($model, 'tgl_entry')->widget(DatePicker::className(), [
        'options' => ['placeholder' => '[ Tanggal Surat ]', 'style' => 'width : 300px'],
        'pluginOptions' => [
            'autoclose' => TRUE,
            'format' => 'yyyy-mm-dd'
        ],
        'removeButton' => false
    ]) ?>

    <?= $form->field($model, 'fisik')->textInput(['maxlength' => true, 'style' => 'width:300px']) ?>

    <?= $form->field($model, 'keuangan')->textInput(['maxlength' => true, 'style' => 'width:300px']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
