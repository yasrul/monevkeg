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
 * @property string $doc_sysfilename
 * @property string $doc_realfilename
 * @property string $dokumen
 */
class Monev extends \yii\db\ActiveRecord
{
    public $filesup;
    
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
            [['tgl_keg','filesup'], 'safe'],
            [['kinerja', 'permasalahan', 'resume', 'rekomendasi', 'doc_sysfilename', 'doc_realfilename','dokumen'], 'string', 'max' => 500],
            [['filesup'], 'file', 'extensions' => ['doc','docx','xls','xlsx','ppt','pptx','jpg','jpeg','png','pdf','zip','rar'],
                'maxSize' => 10*1024*1024,
                'maxFiles' => 5,
                'skipOnEmpty' => TRUE,
            ]
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
            'doc_sysfilename' => 'Nama Dokumen (system)',
            'doc_realfilename' => 'Nama Dokumen (sumber)'
        ];
    }
        
    public function uploadFiles() {
        $filesup = UploadedFile::getInstances($this, 'filesup');
        
        if (!isset($filesup)) {
            return FALSE;
        }
        foreach ($filesup as $key => $fileup) {
            $this->doc_realfilename .= $fileup->name.'**';
            $ext = end((explode(".", $fileup->name)));
            $this->doc_sysfilename .= Yii::$app->security->generateRandomString().".{$ext}".'**';
        }
               
        return $filesup;       
    }
    
    public function getPathFile() {
        return isset($this->doc_sysfilename) ? Yii::getAlias('@app/docfiles/').$this->doc_sysfilename : null;
    }
    
    public function getUrlFile() {
        return isset($this->doc_sysfilename) ? Yii::$app->params['uploadUrl'].$this->doc_sysfilename : null;
    }
    
    public function deleteFile() {
        $file = $this->getPathFile();
        
        if(empty($file) || !file_exists($file)) {
            return FALSE;
        }
        
        if(!unlink($file)) {
            return FALSE;
        }
        
        $this->doc_srcfilename = null;
        $this->doc_appfilename = NULL;
        
        return true;
    }
}
