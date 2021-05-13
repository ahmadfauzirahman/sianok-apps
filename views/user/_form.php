<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <div class="card card-body">
        <?php $form = ActiveForm::begin(); ?>

        <?php $form->field($model, 'userID')->textInput() ?>

        <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => 'Enter Username']) ?>
        <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'placeholder' => 'Enter Nama']) ?>

        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'placeholder' => 'Enter Password']) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Enter Email']) ?>

        <?= $form->field($model, 'telepon')->textInput(['maxlength' => true, 'placeholder' => 'Enter Telphone']) ?>

        <?= $form->field($model, 'role')->dropDownList(['admin' => 'Admin', 'super' => 'Super'], ['prompt' => 'Pilih Role']) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>