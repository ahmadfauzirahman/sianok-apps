<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DataAntrian */

$this->title = "Antrian Stakeholder " . $model->stakeKode;
$this->params['breadcrumbs'][] = ['label' => 'Data Antrian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="data-antrian-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <a target="_blank" href="<?= \yii\helpers\Url::to(['/data-antrian/cetak', 'id' => $model->id]) ?>" class="btn btn-success">Cetak
            Tiket</a>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'counter',
            'stakeKode',
            'waktu:datetime',
            'status',
            'jenis_layanan',
//            'id_kppn',
            'nomor_antrian',
            'nobc',
            'jml_spm',
        ],
    ]) ?>

</div>
