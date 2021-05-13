
var tpm_l = 0;

function ambilAntrian() {
    $.post('antrian-api/index',function(r) {
        // console.log(r)
        if (tpm_l != r.results.length) {
            $(".col-md-3").remove();
            tpm_l = 0;
        }

        if (tpm_l == 0) {
            var data = r.results;
            var no = 1;

            let loket;
            loket = "";
            data.forEach(element => {
                var status = element.status;
                // console.log(element.status);
                if (element.status  == 'Menunggu Antrian'){

                }else if(element.status == 'Proses'){

                }else{

                }
                loket +=
                    `
                  <li class="list-group-item d-flex pd-sm-x-20">
                    <div class="avatar d-none d-sm-block"><span class="avatar-initial rounded-circle bg-primary op-5"><i
                                class="icon ion-md-bus"></i></span></div>
                    <div class="pd-sm-l-10">
                        <p class="tx-medium mg-b-2">`+status+`</p>
                        <small class="tx-12 tx-color-03 mg-b-0">`+element.waktu+`</small>
                    </div>
                        <div class="mg-l-auto text-right">
                            <p class="tx-medium mg-b-2">Jumlah SPM Diajukan `+element.jml_spm+`</p>
                            <small class="tx-12 tx-info mg-b-0">`+element.nama_stakeholder+`</small>
                        </div>
                  </li>`;
                no++;
            });
            $("#list-antrian").children().remove();

            $("#list-antrian").append(loket);
            tpm_l = r.results.length;
        }

    },'JSON')
}

function ambilLog() {
    $.post('log/aktifitas-sistem',function(r) {
        // console.log(r)
        if (tpm_l != r.results.length) {
            $(".col-md-3").remove();
            tpm_l = 0;
        }

        if (tpm_l == 0) {
            var data = r.results;
            var no = 1;

            let loket;
            loket = "";
            data.forEach(e => {
                loket +=
                    `
                  <li class="activity-item">
                        <div class="activity-icon bg-primary-light tx-primary">
                            <i data-feather="clock"></i>
                        </div>
                        <div class="activity-body">
                            <p class="mg-b-2"><strong>`+e.operator+`</strong> `+e.aktifitas+`
                                <a href="" class="link-02"><strong> Pada Page `+e.page+`</strong></a></p>
                            <small class="tx-color-03">`+e.waktu+`</small>
                        </div>
                    </li>
                  `;
                no++;
            });
            $("#loadinglog").children().remove();

            $("#loadinglog").append(loket);
            tpm_l = r.results.length;
        }

    },'JSON')
}
