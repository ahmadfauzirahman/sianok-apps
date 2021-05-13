<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "log".
 *
 * @property int $id_log
 * @property string $waktu
 * @property string $aktifitas
 * @property string $page
 * @property string $operator
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['waktu', 'aktifitas', 'page','operator'], 'required'],
            [['waktu'], 'safe'],
            [['page'], 'string'],
            [['aktifitas'], 'string', 'max' => 252],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_log' => 'Id Log',
            'waktu' => 'Waktu',
            'aktifitas' => 'Aktifitas',
            'page' => 'Page',
            'operator' => 'Operator',
        ];
    }
}
