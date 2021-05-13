<?php

use app\components\HelperKppnBukitTinggi;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PenggunaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Pengguna';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengguna-index">

    <div class="card">
        <div class="card-header">
            <p>
                <?= Html::a('Tambah Pengguna', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
        <div class="card-body">
            <?php Pjax::begin(['enablePushState' => false]); ?>

            <?php // echo $this->render('_search', ['model' => $searchModel]); 
            ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [

                    ['class' => 'yii\grid\SerialColumn'],

                    //            'userID',
                    'username',
                    //            'password',
                    'nama',
                    'email:email',
                    //'telepon',
                    //'foto:ntext',
                    //'tanggal_pendaftaran',
                    [
                        'attribute' => 'role',
                        'filter' => HelperKppnBukitTinggi::getRole(),
                        'value' => function ($model) {
                            return HelperKppnBukitTinggi::role($model->role);
                        }
                    ],
                    //'token_aktivasi:ntext',
                    [
                        'attribute' => 'status',
                        'filter' => ['Aktif' => 'Aktif', 'Tidak Aktif' => 'Tidak Aktif'],


                    ],

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