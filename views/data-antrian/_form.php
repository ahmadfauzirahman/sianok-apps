<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DataAntrian */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-antrian-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'counter')->textInput() ?>

    <?= $form->field($model, 'stakeKode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'waktu')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenis_layanan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_kppn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nomor_antrian')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nobc')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
