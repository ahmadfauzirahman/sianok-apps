<?php


namespace app\controllers;


use app\api\modules\v1\controllers\ControllerBase;
use app\models\DataAntrian;
use app\models\Log;
use app\models\Notifikasi;
use app\models\Stakeholder;
use Mpdf\Mpdf;
use Mpdf\Tag\Q;
use Yii;
use yii\db\Query;
use yii\web\NotFoundHttpException;

class AntrianApiController extends ControllerBase
{
    /*public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $model = new Log();
        $model->waktu = date('Y-m-d H:i:s');
        $model->aktifitas = "Mengakses " . $this->getUniqueId() . "Halaman " .  $this->getViewPath();
        $model->operator = Yii::$app->user->identity->getNama();
        $model->page = $this->getRoute();
        $model->save();

    }*/
    //get antrian
    public function actionIndex()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $query = new Query();
        $data = $query->select([
            'data_antrian.*',
            'stakeholder.nama_stakeholder'
        ])->from('data_antrian')
            ->leftJoin("stakeholder", "stakeholder.kode_stakeholder = data_antrian.stakeKode")
            ->where(['status' => 'Menunggu Antrian'])
            ->orderBy(['id' => SORT_ASC])
            ->limit(6)
            ->createCommand()
            ->queryAll();

        return $this->writeResponse(true, 'Data Antrian Berhasil Diambil', $data);
    }


    // ambil notifikasi 

    public function actionNotifikasi()
    {

        $p = Yii::$app->request->post();
        $data = Notifikasi::find()->where(['kd' => $p['kd']])->all();
        return $this->writeResponse(true, 'Data Notifikasi Berhasil', $data);
    }


    //post antrian
    public function actionAmbilAntrian()
    {
        $barcode = new \Com\Tecnick\Barcode\Barcode();

        date_default_timezone_set('Asia/Jakarta');
        $request = Yii::$app->request;
        if (!$request->isPost) {
            return $this->writeResponse(false, 'Opps');
        }


        $jenis_layanan = $request->post('jenis_layanan');
        $kode_stakeholder = $request->post('kode_stakeholder');
        $jumlah_spm = $request->post('jumlah_spm');

        if (empty($jumlah_spm)) {
            return $this->writeResponse(false, 'Jumlah SPM Tidak Boleh Kosong');
        }
        //cek apakah sudah ambil antrian atau belum untuk hari ini
        $cek = DataAntrian::find()
            ->where(
                [
                    'stakeKode' => $kode_stakeholder,
                    'DATE(waktu)' => date('Y-m-d')
                ]
            )
            ->orderBy('id DESC')->limit(1)->one();

        if (!is_null($cek)) {
            if (!is_null($cek->stakeKode) && $cek->status == 'Menunggu Antrian') {
                return $this->writeResponse(false, 'Anda Telah Mengambil Antrian Untuk Hari Ini');
            }
        }
        if (is_null($jenis_layanan)) {
            return $this->writeResponse(false, 'Terjadi Kesalahan , Hubungi Admin');
        }

        if (is_null($kode_stakeholder)) {
            return $this->writeResponse(false, 'Terjadi Kesalahan , Hubungi Admin');
        }

        if (is_null($jumlah_spm)) {
            return $this->writeResponse(false, 'Jumlah SPM Minimal 1');
        }
        $model = new DataAntrian();
        $model->counter = 1;
        $model->stakeKode = $kode_stakeholder;
        $model->waktu = date('Y-m-d H:i:s');
        $model->status = 'Menunggu Antrian';
        $model->jenis_layanan = $jenis_layanan;
        $model->nobc = $kode_stakeholder . "-" . date('YmdHis');
        $model->jml_spm = $jumlah_spm;
        $model->id_kppn = '043';
        //        $counter = $request->post('jenis_layanan') . "_counter.txt";
        $counter = "SPM_counter.txt";
        $date = "SPM_date.txt";
        //        $date = $request->post('jenis_layanan') . "_date.txt";
        $nomor_antrian = $this->buatNomorAntrian($date, $counter);
        if (strlen($nomor_antrian) == 1) {
            $antrian = "A00" . ((int)$nomor_antrian);
        } else if (strlen($nomor_antrian) == 2) {
            $antrian = "A0" . ((int)$nomor_antrian);
        } else {
            $antrian = "A" . ((int)$nomor_antrian);
        }
        $nokode = $kode_stakeholder . "-" . date('YmdHis');
        $bobj = $barcode->getBarcodeObj('QRCODE', "{$nokode}", 450, 450, 'black', array(0, 0, 0, 0));
        $imageData = $bobj->getPngData();
        $dir = Yii::getAlias('@app') . "\\web\\barcode\\";
        file_put_contents($dir . $nokode . '.png', $imageData);
        $model->nomor_antrian = $antrian;
        $model->no_barcode = $nokode;
        if ($model->save(false)) {
            $data = DataAntrian::findOne($model->id);
            return $this->writeResponse(true, 'Berhasil Mengambil Antrian', [$data]);
        } else {
            return $this->writeResponse(false, 'Tidak Berhasil Mengambil Antrian');
        }
    }


    function buatNomorAntrian($location_date, $location_counter)
    {
        $itis = date("d");

        // Hari baru?
        $aday = join('', file($location_date));
        trim($aday);

        if ($aday == $itis) {
            //Cari hari ini
            $tcounter = join('', file($location_counter));
            trim($tcounter);
            $tcounter++;

            $fp = fopen($location_counter, "w");
            fputs($fp, $tcounter);
            fclose($fp);
        } else {
            //hari baru
            $fp = fopen($location_counter, "w");
            fputs($fp, 0);
            fclose($fp);
            $tcounter = join('', file($location_counter));
            trim($tcounter);
            $tcounter++;
            //tulis hari baru
            $fp = fopen($location_counter, "w");
            fputs($fp, $tcounter);
            fclose($fp);
            //tulis di date.txt
            $fp = fopen($location_date, "w");
            fputs($fp, $itis);
            fclose($fp);
        }

        return $tcounter;
    }

    public function actionCetak($id)
    {
        $size_orientation = 'LEGAL';
        $orientation = 'P';
        $fontsize = 10;

        $NoFoot = 1;
        $data = $this->findModel($id);
        $html = $this->TiketAntrian($data);
        $fontUrl = \Yii::getAlias('@app') . DIRECTORY_SEPARATOR . "font";
        $title = 'KPPN BUKIT TINGGI - ' . $data->stakeKode;
//        $pdf

        $pdf = new Mpdf([
            'mode' => 'utf-8',
            'fontDir' => [
                $fontUrl
            ],
            'fontdata' => [
                'sanserif' => [
                    'R' => 'sanserif.ttf',
                ]
            ],
            'default_font' => 'sanserif',
            'default_font_size' => $fontsize,
            'orientation' => $orientation,
//            'format'=> (($size_orientation=='LEGAL-L')?[330,215]:[215,330]),
//            'format'=> $size_orientation,
        ]);
        $pdf->SetTitle($title);
        $pdf->SetCreator(\Yii::$app->params['app.organization']);
        $pdf->autoPageBreak = true;
        $pdf->AddPageByArray([
            'margin-left' => 3,
            'margin-top' => 3,
            'margin-right' => 6,
            'margin-bottom' => 6,
            'margin-footer' => 2,
        ]);
        $pdf->shrink_tables_to_fit = 1;
        // echo $html;die();
        $pdf->WriteHTML($html);

        $pdf->Output("{$title}.pdf", 'I');
    }

    private function TiketAntrian($html)
    {
        $tanggal = date('Y-m-d 00:00:01');
        $sampai = date('Y-m-d 23:59:59');
        $nama = Stakeholder::find()->where(['kode_stakeholder' => $html->stakeKode])->one();

        return $this->renderPartial('cetak-antrian-tiket', ['model' => $html, 'detail' => $nama]);
    }

    /**
     * Finds the DataAntrian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataAntrian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DataAntrian::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
