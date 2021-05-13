<?php
?>

<hr class="mg-y-40">
<div class="row">
    <div class="col-lg-12">
        <div class="card text-white">
            <div class="card-header">
                <h1 class="text-center">KPPN BUKIT TINGGI</h1>
            </div>
            <div class="row" style="padding: 10px">
                <div class="col-lg-3">
                    <div class="card tx-white bg-success">
                        <div class="card-header">
                            <p class="text-center" style="font-size: 32px">Panggilan</p>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <p style="font-size: 32px" class="card-text">Nomor Antrian</p>
                                <hr class="mg-y-40">

                                <p style="font-size: 32px">SPM -<?= $antrian->nomor_antrian ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">

                    <div class="card tx-white bg-primary">
                        <div class="card-header">
                            <p class="text-center" style="font-size: 32px">Tiket</p>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <p style="font-size: 32px" class="card-text">Nomor Unik</p>
                                <hr class="mg-y-40">
                                <br>
                                <p style="font-size: 26px"><?= $antrian->nobc?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">

                    <div class="card tx-white bg-danger">
                        <div class="card-header">
                            <p class="text-center" style="font-size: 32px">Total</p>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <p style="font-size: 32px" class="card-text">Total Antrian</p>
                                <hr class="mg-y-40">

                                <p style="font-size: 32px"><?= $jumlah - 1 ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">

                    <div class="card tx-white bg-warning">
                        <div class="card-header">
                            <p class="text-center" style="font-size: 32px">Estimasi</p>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <p style="font-size: 32px" class="card-text">Waktu Pelayanan</p>
                                <hr class="mg-y-40">

                                <p style="font-size: 32px">SPM - 1</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

