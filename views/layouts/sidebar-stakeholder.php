<li class="nav-label">Notifikasi</li>
<li class="nav-item">
    <a href="<?= Yii::$app->urlManager->createUrl('notifikasi/index') ?>" class="nav-link">
        <i data-feather="send"></i>
        <span>Notif Saya</span>
    </a>
</li>

<li class="nav-item">
    <a href="<?= Yii::$app->urlManager->createUrl('list-surat/index') ?>" class="nav-link">
        <i data-feather="file"></i>
        <span>Contoh Format Surat</span>
    </a>
</li>