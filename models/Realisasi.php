<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "realisasi".
 *
 * @property integer $id
 * @property integer $id_indikator
 * @property string $tgl_entry
 * @property string $fisik
 * @property string $keuangan
 */
class Realisasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'realisasi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_indikator', 'tgl_entry', 'fisik', 'keuangan'], 'required'],
            [['id_indikator'], 'integer'],
            [['tgl_entry'], 'safe'],
            [['fisik', 'keuangan'], 'number'],
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
            'tgl_entry' => 'Tgl Entry',
            'fisik' => 'Fisik',
            'keuangan' => 'Keuangan',
        ];
    }
}
