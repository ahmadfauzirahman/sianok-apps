<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JenisLayanan */

$this->title = 'Form Jenis Layanan';
$this->params['breadcrumbs'][] = ['label' => 'Jenis Layanan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenis-layanan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
