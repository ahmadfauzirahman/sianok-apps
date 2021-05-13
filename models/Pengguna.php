<?php

namespace app\models;

use Yii;

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
class Pengguna extends \yii\db\ActiveRecord
{
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
}
