<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data User';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <div class="card card-body">

        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('<span class="fa fa-plus"></span> Tambah User', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); 
        ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'userID',
                'username',
                'password',
                'nama',
                'email:email',
                //'telepon',
                //'foto:ntext',
                //'tanggal_pendaftaran',
                //'role',
                //'token_aktivasi:ntext',
                //'status',

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