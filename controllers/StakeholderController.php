<?php

namespace app\controllers;

use app\components\Auth;
use app\models\DataAntrian;
use app\models\Log;
use app\models\Pengguna;
use app\models\User;
use Yii;
use app\models\Stakeholder;
use app\models\StakeholderSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StakeholderController implements the CRUD actions for Stakeholder model.
 */
class StakeholderController extends Controller
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
                        'actions' => ['logout', 'index', 'view', 'update', 'create', 'delete', 'bulk', 'dashboard'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }


    /**
     * Lists all Stakeholder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StakeholderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Stakeholder model.
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
     * Creates a new Stakeholder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Stakeholder();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_stakeholder]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Stakeholder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_stakeholder]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Stakeholder model.
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

    public function actionDashboard()
    {
        $data = Pengguna::findOne(Yii::$app->user->getId());
        $date = date('Y-m-d');
        $antrianSaya = DataAntrian::find()
            ->select("*")
            ->where(['DATE(waktu)' => $date, "status" => "Menunggu Antrian", "stakeKode" => Yii::$app->user->identity->getKodeAkun()])
            ->groupBy(["id"])->one();
        $currentAntrian = DataAntrian::find()
                ->select("*")
                ->where(['DATE(waktu)' => $date, "status" => "Sedang Dilayani"])
                ->orderBy(["id" => SORT_ASC])
                ->one();
//        try {
//
//        }catch (\Exception $exception){
//            print_r($exception);
//        }
        $currentAntrian = $currentAntrian == null ? "Tidak Ada Antrian Hari Ini" : $currentAntrian->nomor_antrian;
//        var_dump($currentAntrian);
//        exit();
        return $this->render('dashboard', ['data' => $data, 'antrianSaya' => $antrianSaya, 'antrianSaatIni' => $currentAntrian]);
    }

    public function actionBulk()
    {
        $action = Yii::$app->request->post('action');
        $selection = (array)Yii::$app->request->post('selection');//typecasting
        echo '<pre>';
        var_dump($action);
        foreach ($selection as $id) {
            $e = Stakeholder::findOne($id);
            $model = new Pengguna();
            $model->username = $e->kode_stakeholder;
            $model->password = md5($e->kode_stakeholder);
            $model->telepon = "";
            $model->foto = "";
            $model->tanggal_pendaftaran = date('Y-m-d');
            $model->token_aktivasi = md5("KPPNBUKTITINGGI");
            var_dump($e);
        }
        exit();
    }

    /**
     * Finds the Stakeholder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Stakeholder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Stakeholder::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
