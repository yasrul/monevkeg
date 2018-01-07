<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Realisasi;

/**
 * RealisasiSearch represents the model behind the search form about `app\models\Realisasi`.
 */
class RealisasiSearch extends Realisasi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_indikator'], 'integer'],
            [['tgl_entry'], 'safe'],
            [['fisik', 'keuangan'], 'number'],
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
        $query = Realisasi::find();

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
            'tgl_entry' => $this->tgl_entry,
            'fisik' => $this->fisik,
            'keuangan' => $this->keuangan,
        ]);

        return $dataProvider;
    }
}
