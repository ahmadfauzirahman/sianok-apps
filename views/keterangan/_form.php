<?php

use app\components\HelperKppnBukitTinggi;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Keterangan */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="keterangan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_jenis_layanan')->widget(Select2::classname(), [
        'data' => HelperKppnBukitTinggi::getJenisLayanan(),
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih Stakeholder'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6,'placeholder'=>'Keterangan Ditolak']) ?>

    <?php $form->field($model, 'tanggal')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>