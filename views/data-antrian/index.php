<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DataAntrianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Antrian';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-antrian-index">
    <div class="card">
        <div class="card-header">
            <h1><?= Html::encode($this->title) ?></h1>

            <p style="display: none">
                <?= Html::a('Tambah Data Antrian', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
        <div class="card-body">

            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

//            'id',
                    'counter',
                    'stakeKode',
                    'waktu',
                    'status',
                    'jenis_layanan',
                    'id_kppn',
                    'nomor_antrian',
                    'nobc',
                    'jml_spm',


                    [
                        'class' => 'app\components\ActionColumn',
                    ],
                ],
                'pager' => [
                    'class' => 'app\components\GridPager',
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
