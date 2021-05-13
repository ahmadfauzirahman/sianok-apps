<?php
/* @var $aplikasi \app\models\Aplikasi */

?>
<div class="card-header pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
    <h6 class="tx-13 tx-spacing-1 tx-uppercase tx-semibold mg-b-0">Aplikasi RSUD</h6>
    <nav class="nav nav-icon-only">
        <a href="" class="nav-link"><i data-feather="more-horizontal"></i></a>
    </nav>
</div><!-- card-header -->
<div class="card-body pd-20 pd-lg-25">
    <ul class="list-group">
        <?php foreach ($aplikasi as $item): ?>
            <li class="list-group-item d-flex align-items-center">
                <img src="<?= Yii::$app->request->baseUrl ?>/img/logo_rsud.jpg" class="wd-30 rounded-circle mg-r-15"
                     alt="">
                <div>
                    <h4 class="tx-15-f tx-inverse tx-semibold mg-b-0"><?= $item->nma ?></h4>
                    <span class="d-block tx-11 text-muted"><?= $item->inf ?></span>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>