<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "token".
 *
 * @property int $id_token
 * @property string $kd
 * @property string $stakeKode
 */
class Token extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'token';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kd', 'stakeKode'], 'required'],
            [['stakeKode'], 'string'],
            [['kd'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_token' => 'Id Token',
            'kd' => 'Kd',
            'stakeKode' => 'Stake Kode',
        ];
    }
}
