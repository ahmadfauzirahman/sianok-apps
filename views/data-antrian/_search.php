<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DataAntrianSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-antrian-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'counter') ?>

    <?= $form->field($model, 'stakeKode') ?>

    <?= $form->field($model, 'waktu') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'jenis_layanan') ?>

    <?php // echo $form->field($model, 'id_kppn') ?>

    <?php // echo $form->field($model, 'nomor_antrian') ?>

    <?php // echo $form->field($model, 'nobc') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
