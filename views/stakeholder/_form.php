<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Stakeholder */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="stakeholder-form">

    <div class="card card-body">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'baes1')->textInput(['maxlength' => true,'placeholder'=>'Enter Baes1']) ?>

        <?= $form->field($model, 'kode_stakeholder')->textInput(['maxlength' => true,'placeholder'=>'Enter Kode Stakeholder']) ?>

        <?= $form->field($model, 'nama_stakeholder')->textInput(['maxlength' => true,'placeholder'=>'Enter Nama Stakeholder']) ?>

        <?php $form->field($model, 'is_delete')->textInput() ?>

        <?php $form->field($model, 'is_active')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>