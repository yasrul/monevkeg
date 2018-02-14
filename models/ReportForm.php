<?php

namespace app\models;
use yii\base\Model;
use Yii;

/**
 * Description of ReportForm
 *
 * @author yasrul
 */
class ReportForm extends Model {
    public $tahun;
    public $kd_prog;
    
    public function rules() {
        return [
            [['tahun'],'required'],
            [['tahun','kd_prog'], 'integer'],
        ];
    }

    public function attributeLabels() {
        return [
            'tahun'=>'Tahun',
            'kd_prog'=>'Program',
        ];
    }
}
