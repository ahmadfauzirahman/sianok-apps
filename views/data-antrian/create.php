<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DataAntrian */

$this->title = 'Create Data Antrian';
$this->params['breadcrumbs'][] = ['label' => 'Data Antrians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-antrian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
