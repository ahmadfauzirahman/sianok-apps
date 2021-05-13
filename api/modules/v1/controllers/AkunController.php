<?php


namespace app\api\modules\v1\controllers;

use app\models\AkunAknUser;
use Yii;

class AkunController extends ControllerBase
{

    public function actionLoginApi()
    {
        $p = Yii::$app->request->post();
        $kodeAkun = $p['KodeAkun'];
        $Password = $p['Password'];

        $user = AkunAknUser::find()->where(['username' => $kodeAkun])->one();

        if ($user) {
            if ($kodeAkun == $user->getUsername() && md5($Password) == $user->getPassword()) {
                return $this->writeResponse(true, 'Berhasil Login',$user);
            } else {
                return $this->writeResponse(false, 'Tidak Berhasil Login');
            }
        } else {
            return $this->writeResponse(false, 'Data User Tidak Ditemukan');
        }
    }

    public function actionGetAkunByKodeAkun()
    {
        $p = Yii::$app->request->post();
        $user = AkunAknUser::find()->where(['username' => $p['KodeAkun']])->one();
        if ($user) {
            return $this->writeResponse(true, 'Berhasil Mengambil Data Akun', [$user]);
        } else {
            return $this->writeResponse(false, 'Tidak Berhasil Mengambil Data Akun', "{}");
        }
    }
}