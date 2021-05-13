<?php

namespace app\models;

use Yii;
use yii\base\InvalidParamException;
use yii\base\Model;
use yii\web\Cookie;

/**
 * LoginForm is the model behind the login form.
 *
 * @property Identitas|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $kodeAkun;
    public $kataSandi;
    public $ingat = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // kodeAkun and password are both required
            [['kodeAkun', 'kataSandi'], 'required', 'message' => 'Masukkan Username  dan kata sandi terlebih dahulu.'],
            // rememberMe must be a boolean value
            ['ingat', 'boolean'],
            // password is validated by validatePassword()
            ['kodeAkun', 'validateKodeAkun'],
        ];
    }

    public function validateKodeAkun()
    {
        if (!$this->hasErrors()) {
            $akun = $this->getUser();
//            var_dump($akun);
//            exit();
            if (is_null($akun)) {
                $this->addError('o', 'Masukkan Username  dan kata sandi kata sandi tidak sesuai. Atau pilih Lupa Kata Sandi yang ada di bawah.');
            } elseif (!$this->isKataSandiValid()) {
                $this->addError('o', 'Kode akun atau kata sandi tidak sesuai.');
            }
        }
    }


    public function login()
    {
        if (!$this->validate()) {
            return false;
        } else {
            $akun = $this->getUser();
            $a = [
                'ida' => $akun->userid,
                'ipa' => Yii::$app->request->userIP,
                'inf' => Yii::$app->request->userAgent
            ];
            $durasi = $this->ingat ? Yii::$app->params['sesi.durasi.panjang'] : Yii::$app->params['sesi.durasi.pendek'];
            $sesi = new Sesi();
            $sesi->attributes = $a;
            $sesi->setTanggalBuat();
            $sesi->setBatasSesi($durasi);
            $sesi->setKodeSesi();
            if (!$sesi->save()) {
                $this->addErrors($sesi->getErrors());
                return false;
            } else {
                $this->generateShared();
                return Yii::$app->user->login(new Identitas($sesi), $durasi);
            }
        }
    }

    public function generateShared()
    {
        $sessionName = Yii::$app->params['shared.session.name'];
        $cookieName = Yii::$app->params['shared.cookie.name'];
        $value = date_timestamp_get(date_create());

        $cookie = $this->createCookie($cookieName, $value);
        Yii::$app->response->getCookies()->add($cookie);
        Yii::$app->session->set($sessionName, $value);
    }

    public function createCookie($cookieName, $cookieValue)
    {
        $data = [
            'name' => $cookieName,
            'value' => $cookieValue,
            'domain' => Yii::$app->params['shared.cookie.domain'],
        ];

        return new Cookie($data);
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = AkunAknUser::getOneKodeAkun($this->kodeAkun);
        }
        return $this->_user;
    }

    public function isKataSandiValid()
    {
        try {

            if (md5($this->kataSandi) == $this->getUser()->getPassword()) {
                return true;
            }
        } catch (InvalidParamException $exception) {
            return false;
        }
    }
}
