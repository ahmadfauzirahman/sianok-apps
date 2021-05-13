<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StakeholderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Stakeholders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stakeholder-index">
    <div class="card ">
        <div class="card-header">
            <?= Html::a('Tambah Stakeholder', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="card-body">
            <?php Pjax::begin(['enablePushState' => false]); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]);
            ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    // [
                    //     'class' => 'yii\grid\CheckboxColumn',
                    // ],
                    [
                        'contentOptions' => ['style' => 'text-align:center'],
                        'class' => 'yii\grid\SerialColumn'
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Aktfikan User',
                        'headerOptions' => ['style' => 'color:#337ab7;text-align:center'],
                        'contentOptions' => ['style' => 'text-align:center'],
                        'template' => '{aktifkan} ',
                        'buttons' => [
                            'aktifkan' => function ($url, $model) {
                                return Html::a('<span class="fa fa-check"></span>', $url, [
                                    'title' => Yii::t('app', 'Aktifkan Stakeholder Untuk Akun Login'), 'class' => 'btn btn-outline-danger rounded-pill'
                                ]);
                            },
                        ],
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'aktifkan') {
                                $url = \yii\helpers\Url::to(['/pengguna/aktifkan', 'id' => $model->kode_stakeholder]);
                                return $url;
                            }
                        }
                    ],

                    // 'id_stakeholder',
                    // 'baes1',
                    [
                        'attribute' => 'kode_stakeholder',
                        'format' => 'raw',
                        // 'headerOptions' => ['style' => 'color:#337ab7;text-align:center'],
                        'contentOptions' => ['style' => 'text-align:center'],
                        'value' => function ($model) {
                            return  '<b><h4>' . $model->baes1 . "-" . $model->kode_stakeholder . '</h4></b>';
                        }
                    ],
                    'nama_stakeholder',
                    // 'is_delete',
                    //'is_active',


                    [
                        'contentOptions' => ['style' => 'text-align:center'],
                        'class' => 'app\components\ActionColumn',
                    ],
                ],
                'pager' => [
                    'class' => 'app\components\GridPager',
                ],
            ]); ?>

            <?php Pjax::end(); ?>
            <?= Html::endForm(); ?>
        </div>
    </div>
</div>