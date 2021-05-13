<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StakeholderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stakeholder-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_stakeholder') ?>

    <?= $form->field($model, 'baes1') ?>

    <?= $form->field($model, 'kode_stakeholder') ?>

    <?= $form->field($model, 'nama_stakeholder') ?>

    <?= $form->field($model, 'is_delete') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
