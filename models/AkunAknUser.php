<?php

namespace app\models;

use Yii;
use app\components\StatusAkun;

/**
 * This is the model class for table "user".
 *
 * @property int $userID
 * @property string $username
 * @property string $password
 * @property string|null $nama
 * @property string|null $email
 * @property string|null $telepon
 * @property string|null $foto
 * @property string|null $tanggal_pendaftaran
 * @property string|null $role
 * @property string|null $token_aktivasi
 * @property string|null $status
 */
class AkunAknUser extends \yii\db\ActiveRecord
{
    /**
     * @return int
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param int $userID
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getNama()
    {
        return $this->nama;
    }

    /**
     * @param string|null $nama
     */
    public function setNama($nama)
    {
        $this->nama = $nama;
    }

    /**
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getTelepon()
    {
        return $this->telepon;
    }

    /**
     * @param string|null $telepon
     */
    public function setTelepon($telepon)
    {
        $this->telepon = $telepon;
    }

    /**
     * @return string|null
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @param string|null $foto
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    /**
     * @return string|null
     */
    public function getTanggalPendaftaran()
    {
        return $this->tanggal_pendaftaran;
    }

    /**
     * @param string|null $tanggal_pendaftaran
     */
    public function setTanggalPendaftaran($tanggal_pendaftaran)
    {
        $this->tanggal_pendaftaran = $tanggal_pendaftaran;
    }

    /**
     * @return string|null
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string|null $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return string|null
     */
    public function getTokenAktivasi()
    {
        return $this->token_aktivasi;
    }

    /**
     * @param string|null $token_aktivasi
     */
    public function setTokenAktivasi($token_aktivasi)
    {
        $this->token_aktivasi = $token_aktivasi;
    }

    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['foto', 'role', 'token_aktivasi', 'status'], 'string'],
            [['tanggal_pendaftaran'], 'safe'],
            [['username', 'password', 'email'], 'string', 'max' => 255],
            [['nama'], 'string', 'max' => 35],
            [['telepon'], 'string', 'max' => 20],
            [['username'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'userID' => 'User ID',
            'username' => 'Username',
            'password' => 'Password',
            'nama' => 'Nama',
            'email' => 'Email',
            'telepon' => 'Telepon',
            'foto' => 'Foto',
            'tanggal_pendaftaran' => 'Tanggal Pendaftaran',
            'role' => 'Role',
            'token_aktivasi' => 'Token Aktivasi',
            'status' => 'Status',
        ];
    }

    public function isBelumAktifasi()
    {
        return $this->sta == StatusAkun::TERDAFTAR;
    }

    public function isSudahAktif()
    {
        return $this->sta == StatusAkun::AKTIF;
    }

    public function isSedangDiblokir()
    {
        return $this->sta == StatusAkun::BLOKIR;
    }


    public static function getOneKodeAkun($kodeAkun, $includeDeleted = false)
    {
        if (is_null($kodeAkun)) {
            return null;
        } else {
            if ($includeDeleted) {
                return self::findOne([
                    'username' => $kodeAkun,
                ]);
            } else {
                return self::findOne([
                    'username' => $kodeAkun,
                    'status' => 'Aktif',
                ]);
            }
        }
    }
}
