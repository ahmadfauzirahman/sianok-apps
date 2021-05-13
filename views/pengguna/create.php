<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pengguna */

$this->title = 'Tambah Pengguna';
$this->params['breadcrumbs'][] = ['label' => 'Pengguna', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
