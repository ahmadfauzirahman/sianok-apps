<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pengguna */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="pengguna-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => 'Masukan Username']) ?>
        </div>
        <?php if ($model->isNewRecord) { ?>
            <div class="col-lg-4">
                <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'placeholder' => 'Masukan Password']) ?>
            </div>
        <?php } ?>
        <div class="col-lg-4">
            <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'placeholder' => 'Masukan Nama Lengkap']) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Masukan Email']) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'telepon')->textInput(['maxlength' => true, 'placeholder' => 'Masukan No Telepon']) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'role')->dropDownList([
                'stakeholder' => 'Stakeholder',
                'admin' => 'Admin',
                'super' => 'Super',
                'ASeksiPd' => 'Admin Seksi Pd',
                'ASeksiMSKI' => 'Admin Seksi MSKI',
                'ASeksiBank' => 'Admin Seksi Bank',
                'ASeksiVera' => 'Admin Seksi Vera',
                'ASBU' => 'Admin SBU'
            ], ['prompt' => 'Pilih Role']) ?>
        </div>
    </div>


    <?php $form->field($model, 'foto')->textarea(['rows' => 6]) ?>

    <?php $form->field($model, 'tanggal_pendaftaran')->textInput() ?>


    <?php $form->field($model, 'token_aktivasi')->textarea(['rows' => 6]) ?>

    <?php $form->field($model, 'status')->dropDownList(['Pending' => 'Pending', 'Aktif' => 'Aktif', 'Non Aktif' => 'Non Aktif',], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>