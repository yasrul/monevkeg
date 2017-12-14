<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "file_kerja".
 *
 * @property integer $id
 * @property integer $id_monev
 * @property string $deskripsi
 * @property string $filename_sys
 * @property string $filename_real
 */
class FileKerja extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'file_kerja';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_monev'], 'required'],
            [['id_monev'], 'integer'],
            [['deskripsi', 'filename_sys', 'filename_real'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_monev' => 'Id Monev',
            'deskripsi' => 'Deskripsi',
            'filename_sys' => 'Filename Sys',
            'filename_real' => 'Filename Real',
        ];
    }
}
