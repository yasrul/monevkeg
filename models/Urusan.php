<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "urusan".
 *
 * @property integer $Kd_Urusan
 * @property string $Nm_Urusan
 */
class Urusan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'urusan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Urusan', 'Nm_Urusan'], 'required'],
            [['Kd_Urusan'], 'integer'],
            [['Nm_Urusan'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Urusan' => 'Kd  Urusan',
            'Nm_Urusan' => 'Nm  Urusan',
        ];
    }
}
