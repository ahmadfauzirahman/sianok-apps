<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NotifikasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::$app->user->identity->getRoles() == 'admin' ? 'Send Notifikasi' : 'Notifikasi Saya';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notifikasi-index">

    <div class="card">
        <?php if (Yii::$app->user->identity->getRoles() == 'admin') { ?>
            <div class="card-header">
                <p>
                    <?= Html::a('Send Notifikasi <span class="typcn typcn-plus-outline"></span>', ['create'], ['class' => 'btn btn-success']) ?>
                </p>

            </div>
        <?php } ?>
        <div class="card-body">
            <?php Pjax::begin(['enablePushState' => false]); ?>

            <?php // echo $this->render('_search', ['model' => $searchModel]);
            ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    // 'id_notifikasi',
                    'kd',
                    [
                        'attribute' => 'status',
                        'filter' => array(\app\components\HelperKppnBukitTinggi::Status_Tolakan)[0]
                    ],
                    'noted:html',
                    // 'operator',
                    'tgl:date',
                    [
                        'attribute' => 'jns',
                        'filter' => array(\app\components\HelperKppnBukitTinggi::JENIS_NOTIFIKASI)[0]
                    ],
                    //'jam',

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