<?php


namespace app\controllers;


use app\models\Log;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class KeluarController extends Controller
{
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $model = new Log();
        $model->waktu = date('Y-m-d H:i:s');
        $model->aktifitas = "Mengakses " . $this->getUniqueId() . "Halaman " .  $this->getViewPath();
        $model->operator = Yii::$app->user->identity->getNama();
        $model->page = $this->getRoute();
        $model->save();

    }
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['post','get'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $sesi = Yii::$app->user->identity->getSesi();

        if($sesi->keluar()) {
            Yii::$app->user->logout(true);
        } else {
            Yii::$app->getSession()->setFlash('warning',$sesi->getErrors());
        }

        return $this->goHome();
    }
}