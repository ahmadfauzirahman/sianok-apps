<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NotifikasiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notifikasi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_notifikasi') ?>

    <?= $form->field($model, 'kd') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'noted') ?>

    <?= $form->field($model, 'operator') ?>

    <?php // echo $form->field($model, 'tgl') ?>

    <?php // echo $form->field($model, 'jam') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
