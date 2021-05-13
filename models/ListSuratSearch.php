<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ListSurat;

/**
 * ListSuratSearch represents the model behind the search form of `app\models\ListSurat`.
 */
class ListSuratSearch extends ListSurat
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_list_surat', 'dilihat'], 'integer'],
            [['judul_surat', 'keterangan', 'status_surat', 'file'], 'safe'],
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
        $query = ListSurat::find();

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
            'id_list_surat' => $this->id_list_surat,
            'dilihat' => $this->dilihat,
        ]);

        $query->andFilterWhere(['like', 'judul_surat', $this->judul_surat])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'status_surat', $this->status_surat])
            ->andFilterWhere(['like', 'file', $this->file]);

        return $dataProvider;
    }
}
