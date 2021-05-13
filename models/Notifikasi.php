<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notifikasi".
 *
 * @property int $id_notifikasi
 * @property string $kd
 * @property string $status
 * @property string $noted
 * @property int $operator
 * @property string $tgl
 * @property string $jam
 * @property string $jns
 */
class Notifikasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notifikasi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kd', 'status', 'noted','jns', 'operator', 'tgl', 'jam'], 'required'],
            [['noted'], 'safe'],
            [['operator'], 'integer'],
            [['tgl', 'jam'], 'safe'],
            [['kd'], 'string', 'max' => 20],
            [['status'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_notifikasi' => 'Id Notifikasi',
            'kd' => 'Kode Stakeholder',
            'status' => 'Status',
            'noted' => 'Noted',
            'operator' => 'Operator',
            'jns' => 'Jenis Notifikasi',
            'tgl' => 'Tanggal',
            'jam' => 'Jam',
        ];
    }
}
