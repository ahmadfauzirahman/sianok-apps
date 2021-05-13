<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Keterangan */

$this->title = 'Update Keterangan: ' . $model->id_ket;
$this->params['breadcrumbs'][] = ['label' => 'Keterangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_ket, 'url' => ['view', 'id' => $model->id_ket]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="keterangan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
