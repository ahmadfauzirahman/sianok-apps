<?php

use app\components\HelperKppnBukitTinggi;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Notifikasi */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="notifikasi-form">

    <?php $form = ActiveForm::begin(['layout'=>'horizontal']); ?>

    <div class="card">
        <div class="card-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="card-body" style="font-size: 15px">
            <div class="row">
                <div class="col-sm-12">
                    <?= $form->field($model, 'kd')->widget(Select2::classname(), [
                        'data' => \yii\helpers\ArrayHelper::map(HelperKppnBukitTinggi::getStakeholder(), 'kode', 'nama_stakeholder'),
                        'language' => 'en',
                        'options' => ['placeholder' => 'Pilih Stakeholder'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>
                </div>
                <div class="col-sm-12">
                    <?= $form->field($model, 'status')->widget(Select2::classname(), [
                        'data' => HelperKppnBukitTinggi::Status_Tolakan,
                        'language' => 'en',
                        'options' => ['placeholder' => 'Pilih Status Notifikasi'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>
                </div>
                <div class="col-sm-12">

                    <?= $form->field($model, 'jns')->widget(Select2::classname(), [
                        'data' => HelperKppnBukitTinggi::JENIS_NOTIFIKASI,
                        'language' => 'en',
                        'options' => ['placeholder' => 'Pilih Jenis Notifikasi'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>
                </div>
            </div>


            <?= $form->field($model, 'noted')->widget(Select2::classname(), [
                'data' => HelperKppnBukitTinggi::getKeteranganSebab(),
                'language' => 'en',
                'options' => ['placeholder' => 'Pilih Keterangan Ditolak', 'multiple' => true],
                'pluginOptions' => [
                    'allowClear' => true
                ],
                'pluginOptions' => [
                    'tags' => true,
                    'tokenSeparators' => [',', ' '],
                    'maximumInputLength' => 10
                ],
            ]); ?>


            <?php $form->field($model, 'operator')->textInput() ?>
            <?php $form->field($model, 'tgl')->textInput() ?>
            <?php $form->field($model, 'jam')->textInput() ?>
        </div>
        <div class="card-footer">
            <div class="form-group" style="font-size: 15px">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-block']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>