<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ListSurat */

$this->title = 'Form List Surat';
$this->params['breadcrumbs'][] = ['label' => 'List Surat', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="list-surat-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>