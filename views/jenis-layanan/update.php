<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JenisLayanan */

$this->title = 'Update Jenis Layanan: ' . $model->nama_layanan;
$this->params['breadcrumbs'][] = ['label' => 'Jenis Layanan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama_layanan, 'url' => ['view', 'id' => $model->id_jns]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jenis-layanan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
