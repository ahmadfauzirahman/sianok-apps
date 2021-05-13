<?php

namespace app\controllers;

use app\components\Auth;
use app\components\HelperKppnBukitTinggi;
use app\models\Log;
use app\models\Notifikasi;
use app\models\Pengguna;
use app\models\Stakeholder;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
//        $model = new Log();
//        $model->waktu = date('Y-m-d H:i:s');
//        $model->aktifitas = "Mengakses " . $this->getUniqueId() . "Halaman " .  $this->getViewPath();
//        $model->operator = Yii::$app->user->identity->getNama();
//        $model->page = $this->getRoute();
//        $model->save();

    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['masuk', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'antrian-dashboard', 'about'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        $data = Yii::$app->db->createCommand("SELECT COUNT(jns) as 'Jumlah',jns as 'Jenis' FROM `notifikasi` GROUP BY jns ")->queryAll();
        $user = Pengguna::find()->count("userID");
        $stakeholder = Stakeholder::find()->count("id_stakeholder");
        if (Yii::$app->user->identity->getRoles() == 'stakeholder'):
            return $this->redirect(['stakeholder/dashboard']);
        endif;

        return $this->render('index', ['data' => $data, 'user' => $user, 'stakeholder' => $stakeholder]);
    }


    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {

        $barcode = new \Com\Tecnick\Barcode\Barcode();
        $bc = "098811-20200715210543";
        $bobj = $barcode->getBarcodeObj('QRCODE', "{$bc}", 450, 450, 'black', array(0, 0, 0, 0));
        $imageData = $bobj->getPngData();
        $dir = Yii::getAlias('@app') . "\\web\\barcode\\";
        file_put_contents($dir . $bc . '.png', $imageData);

        var_dump($dir);
        exit();

        return $this->render('about');
    }

    public function actionAntrianDashboard()
    {
        error_reporting(0);
        $getCountAntrian = HelperKppnBukitTinggi::getCountAntrian();
        $getCountSisaAntrian = HelperKppnBukitTinggi::getCountSisaAntrian();
        $getCurrentAntrian = HelperKppnBukitTinggi::getCurrentAntrian();
        $getAntrianBerikutnya = HelperKppnBukitTinggi::getAntrianBerikutnya();

        return $this->render('antrian-dashboard', [
            'getCountAntrian' => $getCountAntrian,
            'getCountSisaAntrian' => $getCountSisaAntrian,
            'getCurrentAntrian' => $getCurrentAntrian == null ? "Belum Ada Antrian" : $getAntrianBerikutnya,
            'getAntrianBerikutnya' => $getAntrianBerikutnya == null ? "Belum Ada Antrian" : $getAntrianBerikutnya,
        ]);

    }


}
