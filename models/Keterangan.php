<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "keterangan".
 *
 * @property int $id_ket
 * @property int $id_jenis_layanan
 * @property string $keterangan
 * @property string $tanggal
 */
class Keterangan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'keterangan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_jenis_layanan', 'keterangan'], 'required'],
            [['id_jenis_layanan'], 'integer'],
            [['keterangan'], 'string'],
            [['tanggal'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_ket' => 'Id Ket',
            'id_jenis_layanan' => 'Jenis Layanan',
            'keterangan' => 'Keterangan',
            'tanggal' => 'Tanggal',
        ];
    }

    public function getJen()
    {
        return $this->hasOne(JenisLayanan::className(), ['id_jns' => 'id_jenis_layanan']);
    }
}
