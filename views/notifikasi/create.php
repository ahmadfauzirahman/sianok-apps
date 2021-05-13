<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Notifikasi */

$this->title = 'Form Notifikasi';
$this->params['breadcrumbs'][] = ['label' => 'Notifikasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notifikasi-create">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

</div>