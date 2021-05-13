<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\KeteranganSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="keterangan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_ket') ?>

    <?= $form->field($model, 'id_jenis_layanan') ?>

    <?= $form->field($model, 'nama_jenis') ?>

    <?= $form->field($model, 'keterangan') ?>

    <?= $form->field($model, 'tanggal') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
