<?php

namespace app\controllers;

use app\models\Log;
use Yii;
use app\models\Pengguna;
use app\models\PenggunaSearch;
use app\models\Stakeholder;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PenggunaController implements the CRUD actions for Pengguna model.
 */
class PenggunaController extends Controller
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pengguna models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PenggunaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pengguna model.
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
     * Creates a new Pengguna model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pengguna();

        if ($model->load(Yii::$app->request->post())) {

            $model->save();
            return $this->redirect(['view', 'id' => $model->userID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pengguna model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $p = Yii::$app->request->post();
            $password = $p['Pengguna']['password'];
            $model->password = md5($password);
            $model->save();
            //            $model->
            return $this->redirect(['view', 'id' => $model->userID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pengguna model.
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
     * Finds the Pengguna model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pengguna the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pengguna::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAktifkan($id)
    {
        $model = Pengguna::findOne(['username' => $id]);
        if (is_null($model)) {

            $dataStakeholder = Stakeholder::findOne(['kode_stakeholder' => $id]);
            $modelNew = new Pengguna();
            $modelNew->username = $id;
            $modelNew->password = md5($id);
            $modelNew->email = "dummy@kppn-bukit.com";
            $modelNew->nama = $dataStakeholder->nama_stakeholder;
            $modelNew->telepon = "08xxx";
            $modelNew->foto = "user.png";
            $modelNew->tanggal_pendaftaran = date('Y-m-d h:i:s');
            $modelNew->role = 'stakeholder';
            $modelNew->token_aktivasi = md5('kppnbukittinggi');
            $modelNew->status = 'Aktif';

            if ($modelNew->save()) {
                Yii::$app->session->setFlash('success', 'Berhasil Membuat Akun');
                return $this->redirect(['pengguna/index']);
            } else {
                Yii::$app->session->setFlash('warning', 'Tidak Berhasil Membuat Akun');
                return $this->redirect(['pengguna/index']);
            }
        }

        Yii::$app->session->setFlash('warning', 'Akun Sudah Dibuat');
        return $this->redirect(['pengguna/index']);
    }
}
