<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "monev".
 *
 * @property integer $id
 * @property integer $id_indikator
 * @property string $tgl_keg
 * @property string $kinerja
 * @property string $permasalahan
 * @property string $resume
 * @property string $rekomendasi
 */
class Monev extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'monev';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_indikator', 'kinerja'], 'required'],
            [['id_indikator'], 'integer'],
            [['tgl_keg'], 'safe'],
            [['kinerja', 'permasalahan', 'resume', 'rekomendasi'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_indikator' => 'Id Indikator',
            'tgl_keg' => 'Tgl Keg',
            'kinerja' => 'Kinerja',
            'permasalahan' => 'Permasalahan',
            'resume' => 'Resume',
            'rekomendasi' => 'Rekomendasi',
        ];
    }
}
