<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Stakeholder */

$this->title = 'Update Stakeholder: ' . $model->nama_stakeholder;
$this->params['breadcrumbs'][] = ['label' => 'Stakeholders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama_stakeholder, 'url' => ['view', 'id' => $model->id_stakeholder]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="stakeholder-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
