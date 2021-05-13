<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Antrian Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-7">
                        <div id="iframe"></div>
                    </div>
                    <div class="col-lg-5">
                        <div id="tableDetail"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h6><?php echo date('l, d F Y'); ?></h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card ">
                            <div class="card-header">
                                <h6 class=""><span class="fa fa-list"></span> Sisa Antrian </h6>
                            </div>
                            <div class="card-body" id="sisaAntrian">

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card ">
                            <div class="card-header">
                                <h6 class=""><span class="fa fa-business-time"></span> Antrian saat ini </h6>
                            </div>
                            <div class="card-body" id="antrianSaatIni">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card ">
                            <div class="card-header">
                                <h6 class=""><span class="fa fa-user-times"></span> Antrian berikutnya </h6>
                            </div>
                            <div class="card-body" id="antrianBerikutnya">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card ">
                            <div class="card-header">
                                <h6 class=""><span class="fa fa-clock"></span> Estimasi Waktu Tunggu</h6>
                            </div>
                            <div class="card-body" id="waktuTungguEstimasi">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12" style="padding-top: 10px">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <button id="selanjutnya" class="btn btn-outline-danger btn-block"
                                                type="submit">Selanjutnya <span class="fa fa-angle-right"></span>
                                        </button>
                                    </div>
                                    <div class="col-lg-3">
                                        <button class="btn btn-outline-info btn-block" type="submit" id="panggil">Panggil <span data-feather="volume-1"></span>
                                        </button>
                                    </div>
                                    <div class="col-lg-3">
                                        <button class="btn btn-outline-success btn-block" type="submit" id="selesai">Selesai
                                        </button>
                                    </div>
                                    <div class="col-lg-3">
                                        <button class="btn btn-outline-warning btn-block" type="submit" id="reload">Reload Halaman
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$js = <<< JS
    $(document).ready(function() {
        $("#antrianSelanjutnya").on("submit", function (e) {
            e.preventDefault();
            onSaveAntrian(this, e);
        });
        setInterval(() => {
        // $("#sisaAntrian").children().remove();
            ambilAntrian();
            }, 1000);
        
        $("#selanjutnya").on('click',function(e) {
            // alert("Selanjutnya");
          $.post(dev+"api/v1/antrian/selanjutnya",function(r) {
            // console.log(r)
            $("#iframe")
                        .children()
                        .remove();
            $("#tableDetail")
                        .children()
                        .remove();
            let url = dev + "web/data-antrian/cetak?id=" + r.results.id;
            let table = null;
            table = "";
            table += '<table class="table">' +
             '<tbody>' +
              '         <tr>' +
                            '<th scope="col">Kode Stakeholder</th>' +
                            '<td scope="col">'+ r.results.stakeKode+'</td>' +
                        '</tr>' +
                         '<tr>' +
                            '<th scope="col">Waktu & Tanggal Kedatangan</th>' +
                             '<td scope="col">'+ r.results.waktu+'</td>' +
                         '</tr>' +
                          '<tr>' +
                           '<th scope="col">Status Antrian</th>' +
                            '<td scope="col">'+ r.results.status+'</td>' +
                          '</tr>' +
                           '<tr>' +
                            '<th scope="col">Nomor Antrian</th>' +
                             '<td scope="col">'+ r.results.nomor_antrian+'</td>' +
                           '</tr>' +
                           '<tr>' +
                            '<th scope="col">Nomor Unik</th>' +
                             '<td scope="col">'+ r.results.nobc+'</td>' +
                            '</tr>' +
                             '<tr>' +
                              '<th scope="col">Jumlah SPM Yang Diajukan</th>' +
                               '<td scope="col">'+ r.results.jml_spm+'</td>' +
                                '</tr>' +
                                 '</tbody>' +
                                  '</table>';
            console.log(url)
            $("#iframe").append(`<iframe height="300" width="100%" src="`+url+`" frameborder="0"></iframe>`) 
            $("#tableDetail").append(table) 
          })
        })
        
        $("#panggil").on('click',function(e) {
            // alert("Selanjutnya");
          $.post(dev+"api/v1/antrian/panggil-sekarang",function(r) {
            console.log(r)
              $("#iframe")
                        .children()
                        .remove();
            let url = dev + "web/data-antrian/cetak?id=" + r.results.id;
               $("#tableDetail")
                        .children()
                        .remove()
            console.log(url)
            $("#iframe").append(`<iframe height="300" width="100%" src="`+url+`" frameborder="0"></iframe>`);
             let table = null;
             
            table = "";
            table += '<table class="table">' +
             '<tbody>' +
              '         <tr>' +
                            '<th scope="col">Kode Stakeholder</th>' +
                            '<td scope="col">'+ r.results.stakeKode+'</td>' +
                        '</tr>' +
                         '<tr>' +
                            '<th scope="col">Waktu & Tanggal Kedatangan</th>' +
                             '<td scope="col">'+ r.results.waktu+'</td>' +
                         '</tr>' +
                          '<tr>' +
                           '<th scope="col">Status Antrian</th>' +
                            '<td scope="col">'+ r.results.status+'</td>' +
                          '</tr>' +
                           '<tr>' +
                            '<th scope="col">Nomor Antrian</th>' +
                             '<td scope="col">'+ r.results.nomor_antrian+'</td>' +
                           '</tr>' +
                           '<tr>' +
                            '<th scope="col">Nomor Unik</th>' +
                             '<td scope="col">'+ r.results.nobc+'</td>' +
                            '</tr>' +
                             '<tr>' +
                              '<th scope="col">Jumlah SPM Yang Diajukan</th>' +
                               '<td scope="col">'+ r.results.jml_spm+'</td>' +
                                '</tr>' +
                                 '</tbody>' +
                                  '</table>';
            
                        $("#tableDetail").append(table) 

          })
        })
        
        $("#selesai").on('click',function(e) {
            // alert("Selanjutnya");
          $.post(dev+"api/v1/antrian/selesai",function(r) {
            console.log(r)
          })
        })
        
         $("#reload").on('click',function(e) {
            // alert("Selanjutnya");
          $.post(dev+"api/v1/antrian/reload",function(r) {
             $("#iframe")
                        .children()
                        .remove();
            let url = dev + "web/data-antrian/cetak?id=" + r.results.id;
               $("#tableDetail")
                        .children()
                        .remove()
            console.log(url)
            $("#iframe").append(`<iframe height="300" width="100%" src="`+url+`" frameborder="0"></iframe>`);
             let table = null;
             
            table = "";
            table += '<table class="table">' +
             '<tbody>' +
              '         <tr>' +
                            '<th scope="col">Kode Stakeholder</th>' +
                            '<td scope="col">'+ r.results.stakeKode+'</td>' +
                        '</tr>' +
                         '<tr>' +
                            '<th scope="col">Waktu & Tanggal Kedatangan</th>' +
                             '<td scope="col">'+ r.results.waktu+'</td>' +
                         '</tr>' +
                          '<tr>' +
                           '<th scope="col">Status Antrian</th>' +
                            '<td scope="col">'+ r.results.status+'</td>' +
                          '</tr>' +
                           '<tr>' +
                            '<th scope="col">Nomor Antrian</th>' +
                             '<td scope="col">'+ r.results.nomor_antrian+'</td>' +
                           '</tr>' +
                           '<tr>' +
                            '<th scope="col">Nomor Unik</th>' +
                             '<td scope="col">'+ r.results.nobc+'</td>' +
                            '</tr>' +
                             '<tr>' +
                              '<th scope="col">Jumlah SPM Yang Diajukan</th>' +
                               '<td scope="col">'+ r.results.jml_spm+'</td>' +
                                '</tr>' +
                                 '</tbody>' +
                                  '</table>';
            
                        $("#tableDetail").append(table) 
          })
        })
      
      
    })
    function onSaveAntrian()
    {
        var data = $("#antrianSelanjutnya").serialize();
        console.log(data)
    }
    
    

JS;
$this->registerJs($js);
$this->registerJs($this->render('dashboard-antrian.js'))
?>
