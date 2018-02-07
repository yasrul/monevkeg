<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RealisasiKeg;

/**
 * RealisasiKegSearch represents the model behind the search form about `app\models\RealisasiKeg`.
 */
class RealisasiKegSearch extends RealisasiKeg
{
    public $program;
    public $kegiatan;
    //public $KdID_Prog;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Keg', 'Kd_Indikator', 'No_ID'], 'integer'],
            [['Tolak_Ukur', 'Target_Uraian', 'program', 'kegiatan','KdID_Prog'], 'safe'],
            [['Target_Angka'], 'number'],
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
        $query = RealisasiKeg::find()->joinWith(['program', 'kegiatan']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        //$KdIDProg = explode(".", $this->KdID_Prog);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'indikator.Tahun' => $this->Tahun,
            //'Kd_Urusan' => $this->Kd_Urusan,
            //'Kd_Bidang' => $this->Kd_Bidang,
            //'Kd_Unit' => $this->Kd_Unit,
            //'Kd_Sub' => $this->Kd_Sub,
            'indikator.Kd_Prog' => $this->Kd_Prog,
            //'Kd_Keg' => $this->Kd_Keg,
            'Kd_Indikator' => $this->Kd_Indikator,
            'No_ID' => $this->No_ID,
            'indikator.Target_Angka' => $this->Target_Angka,
        ]);

        $query->andFilterWhere(['like', 'indikator.Tolak_Ukur', $this->Tolak_Ukur])
            ->andFilterWhere(['like', 'indikator.Target_Uraian', $this->Target_Uraian])
            ->andFilterWhere(['like', 'program.Ket_Program', $this->program])
            ->andFilterWhere(['like', 'kegiatan.Ket_Kegiatan', $this->kegiatan]);
        
        return $dataProvider;
    }
}
