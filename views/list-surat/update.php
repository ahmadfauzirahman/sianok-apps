<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ListSurat */

$this->title = 'Update List Surat: ' . $model->id_list_surat;
$this->params['breadcrumbs'][] = ['label' => 'List Surats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_list_surat, 'url' => ['view', 'id' => $model->id_list_surat]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="list-surat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
