<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_list_surat".
 *
 * @property int $id_list_surat
 * @property string|null $judul_surat
 * @property string|null $keterangan
 * @property int|null $dilihat
 * @property string|null $status_surat
 * @property string|null $file
 */
class ListSurat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_list_surat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['judul_surat', 'file'], 'string'],
            [['dilihat'], 'integer'],
            [['keterangan'], 'string', 'max' => 150],
            [['status_surat'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_list_surat' => 'Id List Surat',
            'judul_surat' => 'Judul Surat',
            'keterangan' => 'Keterangan',
            'dilihat' => 'Dilihat',
            'status_surat' => 'Status Surat',
            'file' => 'File',
        ];
    }
}
