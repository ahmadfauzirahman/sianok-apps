<?php

namespace app\controllers;

use app\components\Auth;
use app\components\HelperKppnBukitTinggi;
use app\models\Log;
use app\models\Token;
use Yii;
use app\models\Notifikasi;
use app\models\NotifikasiSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NotifikasiController implements the CRUD actions for Notifikasi model.
 */
class NotifikasiController extends Controller
{
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $model = new Log();
        $model->waktu = date('Y-m-d H:i:s');
        $model->aktifitas = "Mengakses " . $this->getUniqueId() . "Halaman " . $this->getViewPath();
        $model->operator = Yii::$app->user->identity->nama;
        $model->page = $this->getRoute();
        $model->save();
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
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'view', 'update', 'create'],
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
     * Lists all Notifikasi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NotifikasiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Notifikasi model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Notifikasi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Notifikasi();

        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();
            // echo '<pre>';
            // var_dump(implode(",",$post['Notifikasi']['noted']));
            // exit();
            $tokens = array();
            $token = Token::find()->where(['kd' => $post['Notifikasi']['kd']])->all();
            foreach ($token as $tokenlist) {
                $tokens[] = $tokenlist->stakeKode;
            }
            $message = [
                'message' => "Tolakan Notifikasi Jenis " . $post['Notifikasi']['jns'],
                "status" => "Tolakan Notifikasi",
                "type" => "Penolakan"
            ];
            //            var_dump($token);
            //            exit();
            $model->noted = implode(",",$post['Notifikasi']['noted']);
            $model->tgl = date('Y-m-d');
            $model->jam = date('H:i:s');
            $model->operator = Yii::$app->user->identity->getId();

            $model->save(false);

            HelperKppnBukitTinggi::send_notification($tokens, $message);


            return $this->redirect(['view', 'id' => $model->id_notifikasi]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Notifikasi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->jam = date('H:i:s');
            $model->save();
            return $this->redirect(['view', 'id' => $model->id_notifikasi]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Notifikasi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Notifikasi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Notifikasi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Notifikasi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
