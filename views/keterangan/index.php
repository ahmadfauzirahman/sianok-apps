<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KeteranganSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Keterangan / Alasan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="keterangan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tambah Keterangan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //            'id_ket',
            [
                'attribute' => 'id_jenis_layanan',
                'value' => 'jen.nama_layanan'
            ],
            'keterangan:ntext',
            // 'tanggal',

            [
                'class' => 'app\components\ActionColumn',
            ]
        ],
        'pager' => [
            'class' => 'app\components\GridPager',
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>