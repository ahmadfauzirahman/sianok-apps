<?php
/* @var $this yii\web\View */
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $model app\models\Pengguna */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Edit Profil';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="pengguna-form">
    <div class="card">
        <div class="card-body">
            <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

            <div class="alert alert-success">
                Berhasil Mengupdate Data Profile
            </div>
            <?php endif; ?>
            <?php $form = ActiveForm::begin(); ?>

            <div class="row">
                <div class="col-lg-4">
                    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => 'Masukan Username','readonly'=>true]) ?>
                </div>
                <!--<div class="col-lg-4">
                    <?php /*$form->field($model, 'password')->passwordInput(['maxlength' => true, 'placeholder' => 'Masukan Password']) */?>
                </div>-->
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
                    <?= $form->field($model, 'role')->dropDownList(['admin' => 'Admin', 'super' => 'Super',], ['prompt' => 'Pilih Role']) ?>

                </div>
            </div>


            <?php $form->field($model, 'foto')->textarea(['rows' => 6]) ?>

            <?php $form->field($model, 'tanggal_pendaftaran')->textInput() ?>


            <?php $form->field($model, 'token_aktivasi')->textarea(['rows' => 6]) ?>

            <?php $form->field($model, 'status')->dropDownList(['Pending' => 'Pending', 'Aktif' => 'Aktif', 'Non Aktif' => 'Non Aktif',], ['prompt' => '']) ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-block']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
