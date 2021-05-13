<?php

/* @var $this yii\web\View */
/* @var $aplikasi \app\models\Aplikasi */

$this->title = 'Dashboard';
date_default_timezone_set('Asia/Jakarta');
$i = 0;
$count = count($data);
$label = "";
$jumlah = "";
foreach ($data as $item) {
    $label .= "'" . $item['Jenis'] . "'";
    $jumlah .= "'" . $item['Jumlah'] . "'";
    if ($i == $count - 1) {
        $label .= "";
        $jumlah .= "";

    } else {
        $label .= ",";
        $jumlah .= ",";
    }
    $i++;
}
$label = (array)$label;
$label = $label[0];

$jumlah = (array)$jumlah;
$jumlah = $jumlah[0];

?>

<div class="row">
    <div class="col-6 col-md-6 col-lg-6 mg-t-10">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="mg-b-0">List Antrian Tunggu</h6>
                <!-- <div class="d-flex tx-18">
                     <a href="" class="link-03 lh-0"><i class="icon ion-md-refresh"></i></a>
                     <a href="" class="link-03 lh-0 mg-l-10"><i class="icon ion-md-more"></i></a>
                 </div>-->
            </div>
            <ul class="list-group list-group-flush tx-13" id="list-antrian">
                <div style="text-align: center" id="loadinggambar">
                    <img src="https://www.mhsjackrabbitsfoundation.com/wp-content/themes/wp-rocket-framework/assets/img/loading.gif"
                         alt="">
                </div>
            </ul>
        </div><!-- card -->
        <hr>
        <div class="card">
            <div class="card-header pd-b-0 pd-x-20 bd-b-0">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h6 class="mg-b-0">Aktifitas Dalam Sistem</h6>
                    <p class="tx-12 tx-color-03 mg-b-0">Data Terakhir Update: <?= date('H') ?></p>
                </div>
            </div><!-- card-header -->
            <div class="card-body pd-20">
                <ul class="activity tx-13" id="loadinglog">
                    <div class="text-center">
                        <img src="https://www.mhsjackrabbitsfoundation.com/wp-content/themes/wp-rocket-framework/assets/img/loading.gif"
                             alt="">
                    </div>

                </ul><!-- activity -->
            </div><!-- card-body -->
        </div><!-- card -->
    </div>
    <div class="col-6 col-md-6 col-lg-6 mg-t-10">
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h6 class="mg-b-0">Jumlah Notifikasi Berdasarkan Jenis</h6>
                        <!-- <div class="d-flex tx-18">
                             <a href="" class="link-03 lh-0"><i class="icon ion-md-refresh"></i></a>
                             <a href="" class="link-03 lh-0 mg-l-10"><i class="icon ion-md-more"></i></a>
                         </div>-->
                    </div>
                    <div class="card-body">
                        <div data-label="Example" class="df-example">
                            <div class="d-md-flex">
                                <div class="ht-250">
                                    <canvas id="chartDonut"></canvas>
                                </div>
                            </div>
                        </div><!-- df-example -->
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mg-b-0">Jumlah User & Stakeholder</h6>
                    </div>
                    <div class="card-body">
                        <h4><i data-feather="user"></i> User <?= $user ?></h4>
                        <h4><i data-feather="users"></i> Stakeholder <?= $stakeholder ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $js = <<< JS
    $(document).ready(function() {
        'use strict'
       /** PIE CHART **/
      var datapie = {
        labels: [$label],
        datasets: [{
          data: [$jumlah],
          backgroundColor: ['#560bd0', '#007bff','#00cccc','#cbe0e3','#74de00']
        }]
      };
      var optionpie = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
          display: true,
        },
        animation: {
          animateScale: true,
          animateRotate: true
        }
      };
    
    
      // For a pie chart
      var ctx9 = document.getElementById('chartDonut');
      var myDonutChart = new Chart(ctx9, {
        type: 'pie',
        data: datapie,
        options: optionpie
      });

       setInterval(() => {
            ambilAntrian();
            ambilLog();
            }, 3000);
    });
    
    
JS;
$this->registerJs($js);
$this->registerJs($this->render("index-function.js"));
?>

