<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pengguna */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Pengguna', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pengguna-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->userID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->userID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'userID',
            'username',
            // 'password',
            'nama',
            'email:email',
            'telepon',
            'foto:ntext',
            'tanggal_pendaftaran',
            'role',
            'token_aktivasi:ntext',
            'status',
        ],
    ]) ?>

</div>
