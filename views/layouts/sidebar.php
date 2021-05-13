<li class="nav-label">Dashboard</li>
<li class="nav-item">
    <a href="<?= Yii::$app->urlManager->createUrl('site/index') ?>" class="nav-link">
        <i data-feather="pie-chart"></i>
        <span>Dashboard Monitoring</span>
    </a>
</li>

<li class="nav-label mg-t-25">Data Master</li>

<li class="nav-item">
    <a href="<?= Yii::$app->urlManager->createUrl('pengguna/index') ?>" class="nav-link">
        <i data-feather="user"></i>
        <span>User KPPN</span>
    </a>
</li>

<li class="nav-item">
    <a href="<?= Yii::$app->urlManager->createUrl('stakeholder/index') ?>" class="nav-link">
        <i data-feather="list"></i>
        <span>Data Stakeholders</span>
    </a>
</li>

<li class="nav-item">
    <a href="<?= Yii::$app->urlManager->createUrl('log/index') ?>" class="nav-link">
        <i data-feather="list"></i>
        <span>Data Log</span>
    </a>
</li>

<li class="nav-item">
    <a href="<?= Yii::$app->urlManager->createUrl('jenis-layanan/index') ?>" class="nav-link">
        <i data-feather="list"></i>
        <span>Jenis Layanan</span>
    </a>
</li>


<li class="nav-item">
    <a href="<?= Yii::$app->urlManager->createUrl('keterangan/index') ?>" class="nav-link">
        <i data-feather="list"></i>
        <span>Data Keterangan / Sebab</span>
    </a>
</li>

<li class="nav-label mg-t-25">Format Surat</li>
<li class="nav-item">
    <a href="<?= Yii::$app->urlManager->createUrl('list-surat/index') ?>" class="nav-link">
        <i data-feather="file"></i>
        <span>Contoh Format Surat</span>
    </a>
</li>
<li class="nav-label mg-t-25">Notifikasi</li>

<li class="nav-item">
    <a href="<?= Yii::$app->urlManager->createUrl('notifikasi/index') ?>" class="nav-link">
        <i data-feather="send"></i>
        <span>Notifikasi</span>
    </a>
</li>

<li class="nav-label mg-t-25" style="display: none">Antrian Online</li>
<div style="display: none">

    <li class="nav-item">
        <a href="<?= Yii::$app->urlManager->createUrl('data-antrian/index') ?>" class="nav-link">
            <i data-feather="list"></i>
            <span>Antrian</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= Yii::$app->urlManager->createUrl('site/antrian-dashboard') ?>" class="nav-link">
            <i data-feather="list"></i>
            <span>Antrian Dashboard</span>
        </a>
    </li>

    <li class="nav-item" style="display: none">
        <a href="<?= Yii::$app->urlManager->createUrl('tampilan-antrian/index') ?>" class="nav-link">
            <i data-feather="list"></i>
            <span>Tampilan Antrian</span>
        </a>
    </li>

    <li class="nav-item" style="display: none">
        <a href="<?= Yii::$app->urlManager->createUrl('tampilan-antrian/panggil') ?>" class="nav-link">
            <i data-feather="list"></i>
            <span>Panggil</span>
        </a>
    </li>
</div>