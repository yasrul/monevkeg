<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "indikator".
 *
 * @property integer $id
 * @property integer $Tahun
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub
 * @property integer $Kd_Prog
 * @property integer $ID_Prog
 * @property integer $Kd_Keg
 * @property integer $Kd_Indikator
 * @property integer $No_ID
 * @property string $Tolak_Ukur
 * @property string $Target_Angka
 * @property string $Target_Uraian
 * @property string $Real_Keu
 * @property string $Real_Fisik
 */
class RealisasiKeg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'indikator';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Keg', 'Kd_Indikator', 'No_ID'], 'required'],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Keg', 'Kd_Indikator', 'No_ID'], 'integer'],
            [['Target_Angka', 'Real_Keu', 'Real_Fisik'], 'number'],
            [['Tolak_Ukur', 'Target_Uraian'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Tahun' => 'Tahun',
            'Kd_Urusan' => 'Kd  Urusan',
            'Kd_Bidang' => 'Kd  Bidang',
            'Kd_Unit' => 'Kd  Unit',
            'Kd_Sub' => 'Kd  Sub',
            'Kd_Prog' => 'Kd  Prog',
            'ID_Prog' => 'Id  Prog',
            'Kd_Keg' => 'Kd  Keg',
            'Kd_Indikator' => 'Kd  Indikator',
            'No_ID' => 'No  ID',
            'Tolak_Ukur' => 'Tolak  Ukur',
            'Target_Angka' => 'Target  Angka',
            'Target_Uraian' => 'Target  Uraian',
            'Real_Keu' => 'Real  Keu',
            'Real_Fisik' => 'Real  Fisik',
        ];
    }
    
    public function getProgram() {
        return $this->hasOne(Program::className(), [
            'Tahun'=>'Tahun',
            'Kd_Urusan'=>'Kd_Urusan',
            'Kd_Bidang'=>'Kd_Bidang',
            'Kd_Unit' => 'Kd_Unit',
            'Kd_Sub' => 'Kd_Sub',
            'Kd_Prog' => 'Kd_Prog',
        ]);
    }
    
    public function getKegiatan() {
        return $this->hasOne(Kegiatan::className(), [
            'Tahun'=>'Tahun',
            'Kd_Urusan'=>'Kd_Urusan',
            'Kd_Bidang'=>'Kd_Bidang',
            'Kd_Unit' => 'Kd_Unit',
            'Kd_Sub' => 'Kd_Sub',
            'Kd_Prog' => 'Kd_Prog',
            'Kd_Keg' => 'Kd_Keg',
        ]);
    }
}
