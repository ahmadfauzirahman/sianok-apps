var tpm_l = 0;

function ambilAntrian() {
    $.post(dev + 'api/v1/antrian/dashboard', function (r) {
        // console.log(r.results);
        let antrianSisa = null;
        let antrianSaatIni = null;
        let antrianBerikutnya = null;
        let waktuTunggu = r.results.sisaAntrian * 10;
        let waktu = null;
        antrianSisa = "";
        antrianSaatIni = "";
        antrianBerikutnya = "";
        waktu = "";
        antrianSisa += `<h1 class="text-center">` + r.results.sisaAntrian + `</h1>`;

        if (r.results.antrianBerikutnya == null) {
            r.results.antrianBerikutnya = "<span style='font-size: 17px'>Belum Ada Antrian</span>";

        }
        if (r.results.antrianSekarang == null) {
            r.results.antrianSekarang = "<span style='font-size: 17px'>Belum Ada Antrian</span>";
        }
        antrianSaatIni += `<h1 class="text-center">` + r.results.antrianSekarang + `</h1>`;
        antrianBerikutnya += `<h1 class="text-center">` + r.results.antrianBerikutnya + `</h1>`;
        waktu += `<h1 class="text-center">` + waktuTunggu + `</h1>`;

        $("#sisaAntrian").children().remove();
        $("#antrianSaatIni").children().remove();
        $("#antrianBerikutnya").children().remove();
        $("#waktuTungguEstimasi").children().remove();
        $("#sisaAntrian").append(antrianSisa);
        $("#antrianSaatIni").append(antrianSaatIni);
        $("#antrianBerikutnya").append(antrianBerikutnya);
        $("#waktuTungguEstimasi").append(waktu);


    }, 'JSON')
}