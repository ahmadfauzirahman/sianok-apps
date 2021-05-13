<?php

namespace app\controllers;

use app\models\Log;
use app\models\Stakeholder;
use Yii;
use app\models\DataAntrian;
use app\models\DataAntrianSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Mpdf\Mpdf;

/**
 * DataAntrianController implements the CRUD actions for DataAntrian model.
 */
class DataAntrianController extends Controller
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
                        'actions' => ['logout', 'index', 'view', 'update', 'create', 'delete', 'cetak'],
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
     * Lists all DataAntrian models.
     * @return mixed
     */
    public function actionIndex()
    {

        // var_dump(md5("123456789"));
        // exit();
        $searchModel = new DataAntrianSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DataAntrian model.
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
     * Creates a new DataAntrian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DataAntrian();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DataAntrian model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DataAntrian model.
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

    public function actionDataAntrian()
    {
        // return
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
