<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DataAntrian;

/**
 * DataAntrianSearch represents the model behind the search form of `app\models\DataAntrian`.
 */
class DataAntrianSearch extends DataAntrian
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'counter'], 'integer'],
            [['stakeKode', 'waktu', 'status', 'jenis_layanan', 'id_kppn', 'nomor_antrian', 'nobc'], 'safe'],
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
        $query = DataAntrian::find();

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
            'id' => $this->id,
            'counter' => $this->counter,
            'waktu' => $this->waktu,
        ]);

        $query->andFilterWhere(['like', 'stakeKode', $this->stakeKode])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'jenis_layanan', $this->jenis_layanan])
            ->andFilterWhere(['like', 'id_kppn', $this->id_kppn])
            ->andFilterWhere(['like', 'nomor_antrian', $this->nomor_antrian])
            ->andFilterWhere(['like', 'nobc', $this->nobc]);

        return $dataProvider;
    }
}
