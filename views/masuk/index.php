<?php
/* @var $this yii\web\View */
$this->title = 'Hi!';

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\LoginForm */


?>
<div class="form-body" class="container-fluid">
    <div class="row">
        <div class="img-holder">
            <div class="bg"></div>
            <div class="info-holder">
                <img src="<?= Yii::$app->request->baseUrl ?>/login/images/graphic3.svg" alt="">
            </div>
        </div>
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    <img src="<?= Yii::$app->request->baseUrl ?>/img/logo.jpeg" style="margin: 0 auto" height="200px" alt="">
                    <hr>
                    <h3>KPPN BUKIT TINGGI</h3>
                    <p><?= \app\widgets\Alert::widget() ?>
                    </p>
                    <p>Notifikasi Stakeholder</p>
                    <form action="#" method="post">
                        <input class="form-control" type="text" name="Masuk[]" placeholder="Username">
                        <input class="form-control" type="password" name="Masuk[]" placeholder="Password">
                        <div class="form-button">
                            <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>"
                                   value="<?= Yii::$app->request->csrfToken ?>">
                            <button id="submit" type="submit" class="ibtn">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
