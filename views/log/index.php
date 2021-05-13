<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Log';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-index">
    <div class="card">
        <div class="card-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="card-body">
            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

//                    'id_log',
                    'waktu',
                    'aktifitas',
                    'page:ntext',
                    'operator:ntext',

                  /*  [
                        'class' => 'app\components\ActionColumn',
                    ],*/
                ],
                'pager' => [
                    'class' => 'app\components\GridPager',
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>


</div>
