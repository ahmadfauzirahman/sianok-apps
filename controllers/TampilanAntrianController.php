<?php

namespace app\controllers;

use app\api\modules\v1\controllers\ControllerBase;
use app\models\DataAntrian;
use app\models\Log;
use yii\base\DynamicModel;
use yii\web\Controller;
use Yii;

class TampilanAntrianController extends Controller
{
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $model = new Log();
        $model->waktu = date('Y-m-d H:i:s');
        $model->aktifitas = "Mengakses " . $this->getUniqueId() . "Halaman " . $this->getViewPath();
        $model->operator = Yii::$app->user->identity->getNama();
        $model->page = $this->getRoute();
        $model->save();

    }

    public function actionIndex()
    {
        $model = new DynamicModel(['tampilan']);
        $model->addRule(['tampilan'], 'required');

        return $this->render('index', ['model' => $model]);
    }


    public function actionTampilanAntrian()
    {
        $t = $_REQUEST['id'];
        if ($t == 'tampilan_depan') {
            return $this->tampilanDepan();
        } else {
            return $this->tampilanPanggil();
        }
    }

    public function tampilanDepan()
    {
        $antrian = DataAntrian::find()->where(
            [
                'DATE(waktu)' => date('Y-m-d'),
                'status' => 'Sedang Dilayani'
            ])->orderBy('id ASC')->limit(1)->one();

        $jumlah = DataAntrian::find()->where([
            'DATE(waktu)' => date('Y-m-d')
        ])->count("id");

        return $this->renderPartial('tampilan-depan', [
            'antrian' => $antrian,
            'jumlah' => $jumlah
        ]);
    }

    public function actionPanggil()
    {
        
    }

    public function tampilanPanggil()
    {
        return $this->renderPartial('tampilan-panggil');
    }

    public function actionGetAntrianOne()
    {
//        echo '<pre>';
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $data = DataAntrian::find()->where(
            [
                'DATE(waktu)' => date('Y-m-d'),
                'status' => 'Sedang Dilayani'
            ])->orderBy('id ASC')->limit(1)->one();
//        var_dump($data);
//        exit();
        return $this->writeResponse(true, 'Berhasil Mengambil Data', $data);
    }

    function writeResponse($condition, $msg = null, $data = null)
    {
        $_res = new \stdClass();
        $_res->con = $condition == true ? true : false;
        $_res->msg = $msg;
        $_res->results = $data;
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        // $response = new \Phalcon\Http\Response();
        // return $response->setContent(json_encode($_res));
        return $_res;
    }


}
