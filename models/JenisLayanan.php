<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jenis_layanan".
 *
 * @property int $id_jns
 * @property string $nama_layanan
 * @property string $status
 */
class JenisLayanan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jenis_layanan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_layanan', 'status'], 'required'],
            [['status'], 'string'],
            [['nama_layanan'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_jns' => 'Id Jns',
            'nama_layanan' => 'Nama Layanan',
            'status' => 'Status',
        ];
    }
}
