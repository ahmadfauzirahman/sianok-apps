<div style="padding: 10px">
    <h1 style="text-align: center;margin-top: 150px">Antrian Online KPPN Bukit Tinggi</h1>
    <table style="border-bottom: 2px solid" width="100%" border="0">
        <tr>
            <th width="100%">
                <img src="<?= Yii::$app->request->baseUrl ?>/img/LogoAntrianOnline-Terbaru.jpg" height="50%" alt="">
            </th>
        </tr>
    </table>
    <div style="">
        <table style="border-bottom: 2px solid;border-collapse: collapse;" width="100%" border="0" cellpadding="0">
            <tr>
                <th style="padding: 0;" width="50%">Kode Stakeholder</th>
                <td><h3><?= $model->stakeKode ?></h3></td>
            </tr>
            <tr>
                <th width="50%">Nama Stakeholder</th>
                <td><h3><?= $detail->nama_stakeholder ?></h3></td>
            </tr>
            <tr>
                <th width="50%">Jenis Layanan</th>
                <td><h3><?= $model->jenis_layanan ?></h3></td>
            </tr>
            <tr>
                <th width="50%">Jumlah SPM Yang Diajukan</th>
                <td><h3><?= $model->jml_spm ?></h3></td>
            </tr>
            <tr>
                <th width="50%">Waktu</th>
                <td><h3><?= $model->waktu ?></h3></td>
            </tr>
            <tr>
                <th width="50%">No Antrian</th>
                <td><h3><?= $model->nomor_antrian ?></h3></td>
            </tr>
            <tr>
                <th>No Barcode</th>
                <td><?= $model->no_barcode ?></td>
            </tr>
        </table>
    </div>
    <table style="border-bottom: 2px solid" width="100%" border="0">
        <tr>
            <th width="100%">
                <img src="<?= Yii::$app->request->baseUrl ?>/barcode/<?= $model->no_barcode ?>.png" height="20%" alt="">
            </th>
        </tr>
    </table>
</div>