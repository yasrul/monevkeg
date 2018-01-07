<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bidang".
 *
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property string $Nm_Bidang
 * @property integer $Kd_Fungsi
 */
class Bidang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bidang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Urusan', 'Kd_Bidang', 'Nm_Bidang', 'Kd_Fungsi'], 'required'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Fungsi'], 'integer'],
            [['Nm_Bidang'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Urusan' => 'Kd  Urusan',
            'Kd_Bidang' => 'Kd  Bidang',
            'Nm_Bidang' => 'Nm  Bidang',
            'Kd_Fungsi' => 'Kd  Fungsi',
        ];
    }
}
