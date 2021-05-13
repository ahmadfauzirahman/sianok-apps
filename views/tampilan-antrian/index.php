<?php
/* @var $this yii\web\View */

/* @var $form yii\widgets\ActiveForm */

/* @var $model yii\base\DynamicModel */

use yii\widgets\ActiveForm;
use app\components\HelperKppnBukitTinggi;
use kartik\select2\Select2;
use yii\helpers\Html;

$this->title = 'Tampilan Antrian';
$this->params['breadcrumbs'][] = $this->title;

//var_dump($model);
//exit();
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'tampilan')->widget(Select2::classname(), [
                'data' => HelperKppnBukitTinggi::TampilanAntrian,
                'language' => 'en',
                'options' => ['placeholder' => 'Pilih Tampilan Antrian'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
            <?= Html::button('Tampilkan <span class="typcn typcn-info"></span>',
                [
                    'class' => 'btn btn-primary btn-sm float-right',
                    'onclick' =>
                        '$.get("' . \yii\helpers\Url::to(['/tampilan-antrian/tampilan-antrian']) . '",
                        {
                            id:$("#dynamicmodel-tampilan").val()
                        })
                        .done(function(data){
                            $("#tampilan-antrian").html(data)
                        });'
                ]) ?>
            <?php ActiveForm::end(); ?>


        </div>
    </div>
    <hr class="mg-y-40">

    <div class="col-lg-12">
        <div class="cardcard-body">
            <div id="tampilan-antrian"></div>
        </div>
    </div>
</div>