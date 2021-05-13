<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DataAntrian */

$this->title = 'Update Data Antrian: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Data Antrians', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="data-antrian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
