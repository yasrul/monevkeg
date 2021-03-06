<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\file\FileInput;
use vova07\imperavi\Widget as Redactor;

/* @var $this yii\web\View */
/* @var $model app\models\Monev */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="monev-form">

    <?php $form = ActiveForm::begin([
        'options'=>['enctype' => 'multipart/form-data'],
    ]); ?>

    <!--<?= $form->field($model, 'id_indikator')->textInput() ?>-->

    <?= $form->field($model, 'tgl_keg')->widget(DatePicker::className(), [
        'options' => ['placeholder' => '[ Tanggal Surat ]', 'style' => 'width : 300px'],
        'pluginOptions' => [
            'autoclose' => TRUE,
            'format' => 'yyyy-mm-dd'
        ],
        'removeButton' => false
    ]) ?>

    <?= $form->field($model, 'kinerja')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'permasalahan')->textarea(['maxlength' => true, 'row'=>'3']) ?>
    <?= $form->field($model, 'resume')->widget(Redactor::className(),[
        'settings' => [
            'lang' => 'en',
            'minHeight' => 200,
            'plugins' => [
                'clips',
                'fullscreen',
            ]
        ]
    ]) ?>
    
    <?= $form->field($model, 'rekomendasi')->widget(Redactor::className(),[
        'settings' => [
            'lang' => 'en',
            'minHeight' => 200,
            'plugins' => [
                'clips',
                'fullscreen',
            ]
        ]
    ]) ?>
    
    <?php if ($model->isNewRecord) : ?>
    <?= $form->field($model, 'filesup[]')->widget(FileInput::className(), [
        'options' => ['multiple' => true],
        'pluginOptions' => [
            'allowedFileExtensions'=>['doc','docx','xls','xlsx','ppt','pptx','jpg','jpeg','png','pdf','zip','rar'], 
            'showUpload'=>FALSE,
            'showCaption'=>TRUE,
            'showRemove'=>true,
            'style' => 'width : 500px'
        ]
    ]); ?>
    <?php else : ?>
    <?= $form->field($model, 'filesup[]')->widget(FileInput::className(), [
        'options' => ['multiple' => true],
        'pluginOptions' => [
            'showUpload' => FALSE,
            'initialPreview' => $urlFiles,
            'initialPreviewAsData'=>true,
            'overwriteInitial'=>false,
            'initialPreviewConfig' => $previewConfig,
            'previewFileType' => 'any',
        ]
    ]); ?>
    <?php endif ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
