<?php

namespace app\controllers;

use app\models\Log;
use app\models\Pengguna;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Yii;

class ProfileController extends Controller
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

    public function actionIndex()
    {
        $id = Yii::$app->user->identity->getId();
        return $this->render('index', ['model' => $this->findModel($id),]);
    }

    public function actionForm($id = null)
    {
        $id = Yii::$app->user->identity->getId();
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->redirect(['form', 'id' => $model->userID]);
        }

        return $this->render('form', ['model' => $model]);
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
}
