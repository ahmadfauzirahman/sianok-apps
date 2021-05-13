<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Notifikasi */

$this->title = $model->kd . "-" . $model->status;
$this->params['breadcrumbs'][] = ['label' => 'Notifikasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="notifikasi-view">

    <div class="card">
        <div class="card-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="card-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    // 'id_notifikasi',
                    'kd',
                    'status',
                    'noted:html',
                    // 'operator',
                    'tgl:date',
                    'jam',
                ],
            ]) ?>
        </div>
        <div class="card-footer">
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id_notifikasi], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id_notifikasi], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
    </div>





</div>