<?php

namespace app\models;

use phpDocumentor\Reflection\Types\String_;
use Yii;

/**
 * This is the model class for table "data_antrian".
 *
 * @property int $id
 * @property int $counter
 * @property string|null $stakeKode
 * @property string $waktu
 * @property string $status
 * @property string|null $jenis_layanan
 * @property string|null $id_kppn
 * @property string|null $nomor_antrian
 * @property string $nobc
 * @property int $jml_spm
 * @property string $no_barcode
 */
class DataAntrian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_antrian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['counter', 'waktu', 'status', 'nobc', 'jml_spm','no_barcode'], 'required'],
            [['counter'], 'integer'],
            [['waktu'], 'safe'],
            [['stakeKode'], 'string', 'max' => 30],
            [['status', 'jenis_layanan', 'id_kppn', 'nomor_antrian'], 'string', 'max' => 100],
            [['nobc'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'counter' => 'Nomor Loket',
            'stakeKode' => 'Kode Stakeholder',
            'waktu' => 'Waktu',
            'status' => 'Status',
            'jenis_layanan' => 'Jenis Layanan',
            'id_kppn' => 'Nomor KPPN',
            'nomor_antrian' => 'Nomor Antrian',
            'nobc' => 'Nomor Unik',
            'jml_spm' => 'Jumlah SPM',
        ];
    }
}
