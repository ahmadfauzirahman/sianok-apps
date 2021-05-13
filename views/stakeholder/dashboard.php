<?php

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
error_reporting(0)
?>
    <div class="row">
        <div class="col-lg-5">
            <div class="card mg-b-20 mg-lg-b-25">
                <div class="card-header pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
                    <h6 class="tx-uppercase tx-semibold mg-b-0">Saya</h6>
                </div><!-- card-header -->
                <div class="card-body pd-25">
                    <div class="media d-block d-sm-flex">
                        <div class="wd-80 ht-80 bg-ui-04 rounded d-flex align-items-center justify-content-center">
                            <img src="<?= Yii::$app->request->baseUrl ?>/img/user1_128.png" alt="">
                        </div>
                        <div class="media-body pd-t-25 pd-sm-t-0 pd-sm-l-25">
                            <h5 class="mg-b-5"><?= Yii::$app->user->identity->getNama() ?></h5>
                            <p class="mg-b-3 tx-color-02">
                                <span class="tx-color-01"><i><?= Yii::$app->user->identity->getRoles() ?></i></span>
                            </p>
                            <p class="mg-b-3 tx-color-02">
                                <span class="tx-color-01"><b><?= Yii::$app->user->identity->getKodeAkun() ?></b></span>
                            </p>
                        </div>


                    </div><!-- media -->
                    <hr class="mg-y-25">

                    <did class="row">
                        <div class="col-lg-12">
                            <a href="#" data-value="<?= Yii::$app->user->identity->getId() ?>" id="changefoto"
                               class="btn btn-block btn-outline-info">Change Foto <span class="fa fa-image"></span></a>
                        </div>
                        <div class="col-lg-12 mg-y-25">
                            <a href="#" data-value="<?= Yii::$app->user->identity->getId() ?>" id="changepassword"
                               class="btn btn-block btn-outline-warning">Change Password <span
                                        class="fa fa-lock"></span></a>
                        </div>
                    </did>
                    <hr class="mg-y-25">
                    <h5 class="text-center">Data Profil Diri Saya</h5>
                    <span class="mr-lg-2"></span>
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Nama Lengkap</th>
                            <td><?= $data->username ?></td>

                        </tr>
                        <tr>
                            <th>Telepon</th>
                            <td><?= $data->telepon ?></td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td><?= $data->role ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td><?= $data->email ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-7" style="display: none;">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="text-center tx-uppercase tx-semibold mg-b-0">Ambil Antrian</h6>
                        </div>
                        <?php if ($antrianSaya->stakeKode == Yii::$app->user->identity->getKodeAkun() && $antrianSaya->status == "Menunggu Antrian"): ?>
                            <div class="card-body bg-aqua">
                                <img src="<?= Yii::$app->request->baseUrl ?>/img/logo.jpeg" class="img-thumbnail"
                                     alt="">
                                <div class="row" style="margin-top: 10px">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th>Tanggal & Waktu Kedatangan</th>
                                            <td><?= $antrianSaya->waktu ?></td>
                                        </tr>
                                        <tr>
                                            <th>Kode Boking</th>
                                            <td><?= $antrianSaya->no_barcode ?></td>
                                        </tr>
                                        <tr>
                                            <th>No Antrian</th>
                                            <td><?= $antrianSaya->nomor_antrian ?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row" style="margin-top: 10px">
                                    <div class="col-lg-6">
                                        <img class="img-thumbnail" width="100%"
                                             src="<?= Yii::$app->request->baseUrl ?>/barcode/<?= $antrianSaya->no_barcode ?>.png"
                                             alt="">
                                    </div>
                                    <div class="col-lg-6">
                                        <p>Tunjukan Barcode Ini Kepada Petugas Pelayanan KPPN</p>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 10px">
                                    <div class="col-lg-12">
                                        <a target="_blank"
                                           href="<?= \yii\helpers\Url::to(['/data-antrian/cetak', 'id' => $antrianSaya->id]) ?>"
                                           class="btn btn-outline-success btn-block">Cetak
                                            E-Tiket</a>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="card-body bg-aqua">
                                <img src="<?= Yii::$app->request->baseUrl ?>/img/mesin_antrian.png" alt="">
                                <hr>
                                <a href="#" data-value="<?= Yii::$app->user->identity->getKodeAkun() ?>"
                                   id="ambilAntrianClick"
                                   class="btn btn-block btn-outline-success">Ambil Antrian Online<span
                                            class="fa fa-send"></span></a>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="text-center tx-uppercase tx-semibold mg-b-0">Antrian Saat Ini</h6>
                        </div>
                        <div class="card-body">
                            <h3><?= $antrianSaatIni ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAmbilAntrian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="changepasswordTitle">Modal Title</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="ambilAntrian" id="ambilAntrian">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <img src="<?= Yii::$app->request->baseUrl ?>/img/asking.png" class="img-thumbnail"
                                     width="100%" alt="">
                            </div>
                            <div class="col-lg-6">
                                <h4 class="text-maroon text-center  tx-semibold mg-b-7">Apakah Anda Sudah Yakin
                                    Mendaftar Antrean?</h4>
                                <p class="text-center">Tanggal Kedatangan Hari Ini , <?php echo date('l, d F Y'); ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <input type="text" name="jumlah_spm" id="jumlah_spm" class="form-control"
                                   placeholder="Jumlah Spm Yang Dibawa">
                        </div>
                        <input type="hidden" name="jenis_layanan" id="jenis_layanan" value="SPM" readonly>
                        <input type="hidden" name="kode_stakeholder" id="kode_stakeholder"
                               value="<?= Yii::$app->user->identity->getKodeAkun() ?>" readonly>
                        <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>"
                               value="<?= Yii::$app->request->csrfToken ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary tx-13" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary tx-13">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
$JS = <<< JS
    $(document).ready(function() {
    // change password
    $("#ambilAntrianClick").on('click',function() {
        $("#changepasswordTitle").html("<i class='typcn typcn-pencil'></i> &nbsp;Antrian Online")
        $("#modalAmbilAntrian").modal('show');
    })
    
        $("#ambilAntrian").on("submit", function (e) {
            e.preventDefault();
            onSaveAntrian(this, e);
       });
    })
    
   function onSaveAntrian() {
    var data = $("#ambilAntrian").serialize();
    console.log(data)
        $.post("http://localhost/sianok/web/antrian-api/ambil-antrian", data, function (response) {
            console.log(response);
            if (response.con) {
               console.log(response.con) 
                Swal.fire({
                    title: "Good job!",
                    text: "You clicked the button!",
                    type: "success",
                    confirmButtonClass: "btn btn-confirm mt-2"
                })
                $("#modalAmbilAntrian").modal("hide");
                  setTimeout(function(){ 
                    location.reload();
                  }, 3000);
            } else {
                 Swal.fire({
                    type: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                    confirmButtonClass: "btn btn-confirm mt-2",
                    footer: '<a href="">Why do I have this issue?</a>'
                 })
                 $("#modalAmbilAntrian").modal("hide");
                
            }
        }, 'JSON')
    }
JS;
$this->registerJs($JS);
?>