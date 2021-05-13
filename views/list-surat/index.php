<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ListSuratSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'List Surat KPPN Bukit Tinggi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="list-surat-index">

    <p>
        <?= Html::a('Tambah List Surat', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_list_surat',
            'judul_surat:html',
            'keterangan',
            // 'dilihat',
            'status_surat',
            [
                'headerOptions' => ['style' => 'color:#337ab7;text-align:center'],
                'contentOptions' => ['style' => 'text-align:center'],
                'attribute' => 'file',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<a data-pjax="0" href="' . Url::to('@web/file-surat/' . $model->file) . '" target="_blank" class="btn btn-primary">Download File</a>';
                }
            ],

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