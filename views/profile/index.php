<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $model app\models\Pengguna */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Profil Saya', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Profile Saya</h1>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
//                    'userID',
                    'username',
//                    'password',
                    'nama',
                    'email:email',
                    'telepon',
//                    'foto:ntext',
                    'tanggal_pendaftaran',
                    'role',
//                    'token_aktivasi:ntext',
                    'status',
                ],
            ]) ?>
        </div>
    </div>
</div>