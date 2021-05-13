<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PenggunaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengguna-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'userID') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'password') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'telepon') ?>

    <?php // echo $form->field($model, 'foto') ?>

    <?php // echo $form->field($model, 'tanggal_pendaftaran') ?>

    <?php // echo $form->field($model, 'role') ?>

    <?php // echo $form->field($model, 'token_aktivasi') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
