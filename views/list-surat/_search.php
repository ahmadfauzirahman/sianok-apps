<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ListSuratSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="list-surat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_list_surat') ?>

    <?= $form->field($model, 'judul_surat') ?>

    <?= $form->field($model, 'keterangan') ?>

    <?= $form->field($model, 'dilihat') ?>

    <?= $form->field($model, 'status_surat') ?>

    <?php // echo $form->field($model, 'file') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
