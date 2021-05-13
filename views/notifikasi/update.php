<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Notifikasi */

$this->title = 'Update Notifikasi: ' . $model->id_notifikasi;
$this->params['breadcrumbs'][] = ['label' => 'Notifikasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kd, 'url' => ['view', 'id' => $model->id_notifikasi]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="notifikasi-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
