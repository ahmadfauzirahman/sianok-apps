<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Notifikasi;
use Yii;

/**
 * NotifikasiSearch represents the model behind the search form of `app\models\Notifikasi`.
 */
class NotifikasiSearch extends Notifikasi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_notifikasi', 'operator'], 'integer'],
            [['kd', 'status', 'jns', 'noted', 'tgl', 'jam'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Notifikasi::find();
//        var_dump(Yii::$app->user->identity->getKodeAkun());
//        exit();
        if (Yii::$app->user->identity->getRoles() == 'stakeholder') {
           $query->where(['kd'=>Yii::$app->user->identity->getKodeAkun()]);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_notifikasi' => $this->id_notifikasi,
            'operator' => $this->operator,
            'tgl' => $this->tgl,
            'jam' => $this->jam,
        ]);

        $query->andFilterWhere(['like', 'kd', $this->kd])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'jns', $this->jns])
            ->andFilterWhere(['like', 'noted', $this->noted]);

        return $dataProvider;
    }
}
