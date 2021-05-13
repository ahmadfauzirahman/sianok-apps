<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pengguna */

$this->title = 'Update Pengguna: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Penggunas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->userID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengguna-create">
    <div class="card">
        <div class="card-header">
            <h1><?= Html::encode($this->title) ?></h1>

        </div>
        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>

