<?php


namespace app\api\modules\v1\controllers;


use app\components\HelperKppnBukitTinggi;
use app\models\DataAntrian;
use app\models\Token;
use Yii;

class AntrianController extends ControllerBase
{
    //get antrian
    public function actionIndex()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $this->writeResponse(true, 'Data Antrian', md5(123456789));
    }

    public function actionDashboard()
    {
        error_reporting(0);

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $getCountAntrian = HelperKppnBukitTinggi::getCountAntrian();
        $getCountSisaAntrian = HelperKppnBukitTinggi::getCountSisaAntrian();
        $getCurrentAntrian = HelperKppnBukitTinggi::getCurrentAntrian();
        $getAntrianBerikutnya = HelperKppnBukitTinggi::getAntrianBerikutnya();

        $data = [
            'sisaAntrian' => $getCountSisaAntrian,
            'antrianSekarang' => $getCurrentAntrian->nomor_antrian,
            'antrianBerikutnya' => $getAntrianBerikutnya->nomor_antrian,
            'stakeKodeSrkg' => $getCurrentAntrian->stakeKode,
            'stakeKodeSelanjutnya' => $getAntrianBerikutnya->stakeKode
        ];

        return $this->writeResponse(true, 'Data Antrian', $data);

    }

    public function actionSelanjutnya()
    {
        $getAntrianBerikutnya = HelperKppnBukitTinggi::getAntrianBerikutnya();
        $getAntrianBerikutnya->status = "Sedang Dilayani";
        $getAntrianBerikutnya->update();
        return $this->writeResponse(true, 'Panggil', $getAntrianBerikutnya);
    }

    public function actionReload()
    {
        $getCurrentAntrian = HelperKppnBukitTinggi::getCurrentAntrian();

        return $this->writeResponse(true, 'Panggil', $getCurrentAntrian);
    }

    public function actionPanggilSekarang()
    {
        $getAntrianBerikutnya = HelperKppnBukitTinggi::getCurrentAntrian();

        $tokens = array();
        $token = Token::find()->where(['kd' => $getAntrianBerikutnya->stakeKode])->all();

        $message = [
            'message' => "Panggilan Antrian Untuk Nomor Antrian " . $getAntrianBerikutnya->nomor_antrian,
            "status" => "Front Office KPPN Bukit Tinggi",
            "type" => "Penolakan"
        ];
        foreach ($token as $tokenlist) {
            $tokens[] = $tokenlist->stakeKode;
        }

        $sendNotifi = HelperKppnBukitTinggi::send_notification($tokens, $message);

        if ($sendNotifi) {
            return $this->writeResponse(true, 'Panggil', $getAntrianBerikutnya);
        }

    }

    public function actionSelesai()
    {
        $getAntrianBerikutnya = HelperKppnBukitTinggi::getCurrentAntrian();

        $tokens = array();
        $token = Token::find()->where(['kd' => $getAntrianBerikutnya->stakeKode])->all();

        $message = [
            'message' => "Terima Kasih Telah Datang Ke KPPN BUKIT TINGGI",
            "status" => "Front Office KPPN Bukit Tinggi :)",
            "type" => "Penolakan"
        ];
        foreach ($token as $tokenlist) {
            $tokens[] = $tokenlist->stakeKode;
        }
        $getAntrianBerikutnya->status = "Selesai";
        $getAntrianBerikutnya->update();
        $sendNotifi = HelperKppnBukitTinggi::send_notification($tokens, $message);

        if ($sendNotifi) {
            return $this->writeResponse(true, 'Panggil', $sendNotifi);
        }
    }


    public function actionCek()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $p = Yii::$app->request->post();

        $dataAntrian = DataAntrian::find()->where(['stakeKode' => $p['kd'], 'DATE(waktu)' => date('Y-m-d')])->one();

        if (is_null($dataAntrian)) {
            return $this->writeResponse(false, 'Data Antrian Tidak Ada', []);

        } elseif ($dataAntrian->status == 'Selesai') {
            return $this->writeResponse(false, 'Data Antrian Ada , Tapi Sudah Selesai', []);

        } else {
            return $this->writeResponse(true, "Data Antrian Ada", [$dataAntrian]);
        }
    }


}