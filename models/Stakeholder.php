<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stakeholder".
 *
 * @property int $id_stakeholder
 * @property string $baes1
 * @property string $kode_stakeholder
 * @property string $nama_stakeholder
 * @property int|null $is_delete
 * @property int|null $is_active
 */
class Stakeholder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stakeholder';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['baes1', 'kode_stakeholder', 'nama_stakeholder'], 'required'],
            [['is_delete', 'is_active'], 'integer'],
            [['baes1', 'kode_stakeholder', 'nama_stakeholder'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_stakeholder' => 'Id Stakeholder',
            'baes1' => 'Baes1',
            'kode_stakeholder' => 'Kode Stakeholder',
            'nama_stakeholder' => 'Nama Stakeholder',
            'is_delete' => 'Is Delete',
            'is_active' => 'Is Active',
        ];
    }
}
