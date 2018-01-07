<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Monev;

/**
 * MonevSearch represents the model behind the search form about `app\models\Monev`.
 */
class MonevSearch extends Monev
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_indikator'], 'integer'],
            [['tgl_keg', 'kinerja', 'pemasalahan', 'resume', 'rekomendasi'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Monev::find();

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
            'id_indikator' => $this->id_indikator,
            'tgl_keg' => $this->tgl_keg,
        ]);

        $query->andFilterWhere(['like', 'kinerja', $this->kinerja])
            ->andFilterWhere(['like', 'pemasalahan', $this->pemasalahan])
            ->andFilterWhere(['like', 'resume', $this->resume])
            ->andFilterWhere(['like', 'rekomendasi', $this->rekomendasi]);

        return $dataProvider;
    }
}
