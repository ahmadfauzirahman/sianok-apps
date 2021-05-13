<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use app\components\Breadcrumbs;
use app\assets\AppAsset;

//raoul2000\bootswatch\BootswatchAsset::$theme = 'United';
\app\assets\AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Quicksand', sans-serif !important;
            }
        </style>
        <script>
            const dev = "http://localhost/sianok/";
            const prod = "https://sianok.deadline.id/"
        </script>
        <?php $this->head() ?>
    </head>

    <?php $this->beginBody() ?>
    <body class="page-profile">

    <aside class="aside aside-fixed">
        <div class="aside-header">
            <a href="<?= Yii::$app->urlManager->createUrl('site/index') ?>" style="font-size: 20px;" class="aside-logo"><b>KPPN Bukit<span>Tinggi</span></b></a>
            <a href="" class="aside-menu-link">
                <i data-feather="menu"></i>
                <i data-feather="x"></i>
            </a>
        </div>
        <div class="aside-body">
            <div class="aside-loggedin">
                <div class="d-flex align-items-center justify-content-start">
                    <a href="" class="avatar"><img src="<?= Yii::$app->request->baseUrl ?>/img/user1_128.png"
                                                   class="rounded-circle" alt=""></a>
                    <div class="aside-alert-link">

                        <a href="<?= \yii\helpers\Url::to(['/keluar/index']) ?>" data-toggle="tooltip" title="Sign out"><i
                                    data-feather="log-out"></i></a>
                    </div>
                </div>
                <div class="aside-loggedin-user">
                    <a href="#loggedinMenu" class="d-flex align-items-center justify-content-between mg-b-2"
                       data-toggle="collapse">
                        <h6 class="tx-semibold mg-b-0"><?= Yii::$app->user->identity->getNama() ?></h6>
                        <i data-feather="chevron-down"></i>
                    </a>
                    <p class="tx-color-03 tx-12 mg-b-0 text-capitalize"><?= Yii::$app->user->identity->getRoles() ?></p>
                </div>
                <div class="collapse" id="loggedinMenu">
                    <ul class="nav nav-aside mg-b-0">
                        <li class="nav-item"><a href="<?= \yii\helpers\Url::to(['/profile/form']) ?>"
                                                class="nav-link"><i
                                        data-feather="edit"></i>
                                <span>Edit Profile</span></a></li>
                        <li class="nav-item"><a href="<?= \yii\helpers\Url::to(['/profile/index']) ?>" class="nav-link"><i
                                        data-feather="user"></i>
                                <span>View Profile</span></a></li>
                        <li class="nav-item"><a href="<?= \yii\helpers\Url::to(['/keluar/index']) ?>"
                                                class="nav-link"><i data-feather="log-out"></i>
                                <span>Sign Out <?= Yii::$app->user->identity->getRoles() ?></span></a></li>
                    </ul>
                </div>
            </div><!-- aside-loggedin -->
            <ul class="nav nav-aside">
                <?php if (Yii::$app->user->identity->getRoles() == 'stakeholder'): ?>
                    <?= $this->render('sidebar-stakeholder.php') ?>
                <?php else: ?>
                    <?= $this->render('sidebar.php') ?>
                <?php endif; ?>
            </ul>
        </div>
    </aside>

    <div class="content ht-100v pd-0">
        <div class="content-header">
            <div class="content-search">
                <i data-feather="search"></i>
                <input type="search" class="form-control" placeholder="Search">
            </div>
            <nav class="nav">
                <a href="" class="nav-link"><i data-feather="help-circle"></i></a>
                <a href="" class="nav-link"><i data-feather="grid"></i></a>
                <a href="" class="nav-link"><i data-feather="align-left"></i></a>
            </nav>
        </div><!-- content-header -->

        <div class="content-body">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div><!-- content-body -->
    </div><!-- content -->
    </body>
    <?php $this->endBody() ?>

    <script>
        yii.confirm = function (message, okCallback, cancelCallback) {
            Swal.fire({
                title: 'Perhatian!',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.value) {
                    okCallback()
                    // console.log(okCallback);

                    // Swal.fire(
                    //     'Deleted!',
                    //     'Your file has been deleted.',
                    //     'success'
                    // )
                }
            })
        };
    </script>

    </html>
<?php $this->endPage() ?>