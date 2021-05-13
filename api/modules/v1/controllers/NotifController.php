<?php


namespace app\api\modules\v1\controllers;

use app\models\DataAntrian;
use app\models\Notifikasi;
use Phalcon\Cache\Frontend\Data;
use Yii;

class NotifController extends ControllerBase
{
    public function actionIndex()
    {
        $p = Yii::$app->request->post();
        $data = Notifikasi::find()->where(['kd' => $p['KodeAkun']])->orderBy('id_notifikasi DESC')->all();

        if (count($data) > 0) {
            return $this->writeResponse(true, 'Data Notifikasi', $data);
        } else {
            return $this->writeResponse(false, 'Data Notifikasi Tidak Ada');
        }
    }

    public function actionGetNotifikasiById()
    {
        $p = Yii::$app->request->post();
        $notifikasi = Notifikasi::findOne($p['id']);

        if ($notifikasi) {
            return $this->writeResponse(true, 'Data Notifikasi', [$notifikasi]);
        } else {
            return $this->writeResponse(false, 'Data Notifikasi Tidak Ada');
        }
    }
}