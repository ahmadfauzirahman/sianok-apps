<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ListSurat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="list-surat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'judul_surat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dilihat')->textInput() ?>

    <?= $form->field($model, 'status_surat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
