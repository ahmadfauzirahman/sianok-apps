<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JenisLayanan */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="jenis-layanan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_layanan')->textInput(['maxlength' => true, 'placeholder' => 'Nama Layanan']) ?>

    <?= $form->field($model, 'status')->dropDownList(['Aktif' => 'Aktif', 'Tidak Aktif' => 'Tidak Aktif',], ['prompt' => 'Status Layanan']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
