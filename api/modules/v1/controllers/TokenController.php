<?php


namespace app\api\modules\v1\controllers;


use app\models\Token;

class TokenController extends ControllerBase
{
    public function actionToken()
    {
        $token = $_POST['token'];
        $stakekode = $_POST['kd'];
        $data = Token::find()->where(['kd' => $stakekode])->one();


        if ($data ==  null) {
            $model = new Token();
            $model->kd = $stakekode;
            $model->stakeKode = $token;
            $model->save(FALSE);
        } else {
            $data->kd = $stakekode;
            $data->stakeKode = $token;
            $data->update();
        }


        return $this->writeResponse(true, 'Insert Berhasil', []);
    }


    public function actionListToken()
    {
        $data = Token::find()->all();
        return $this->writeResponse(true, 'Data Berhasil Diambil', $data);
    }
}
