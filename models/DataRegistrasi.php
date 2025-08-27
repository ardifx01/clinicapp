<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "data_registrasi".
 *
 * @property int $id_registrasi
 * @property string|null $no_registrasi
 * @property string|null $no_rekam_medis
 * @property string|null $nama_pasien
 * @property string|null $tanggal_lahir
 * @property int|null $nik
 * @property int|null $create_by
 * @property string|null $create_time_at
 * @property int|null $update_by
 * @property string|null $update_time_at
 *
 * @property DataForm[] $dataForms
 */
class DataRegistrasi extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_registrasi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_registrasi', 'no_rekam_medis', 'nama_pasien', 'tanggal_lahir', 'nik', 'create_by', 'create_time_at', 'update_by', 'update_time_at'], 'default', 'value' => null],
            [['tanggal_lahir', 'create_time_at', 'update_time_at'], 'safe'],
            [['nik', 'create_by', 'update_by'], 'default', 'value' => null],
            [['nik', 'create_by', 'update_by'], 'integer'],
            [['no_registrasi', 'no_rekam_medis'], 'string', 'max' => 20],
            [['nama_pasien'], 'string', 'max' => 255],
            [['no_registrasi'], 'unique'],
            ['nik', 'string', 'max' => 16, 'message' => 'NIK tidak boleh lebih dari 16 digit.'],
            ['nik', 'match', 'pattern' => '/^[0-9]{16}$/', 'message' => 'NIK harus berupa 16 digit angka.'],
            [['is_delete'], 'boolean']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_registrasi' => 'Id Registrasi',
            'no_registrasi' => 'No Registrasi',
            'no_rekam_medis' => 'No Rekam Medis',
            'nama_pasien' => 'Nama Pasien',
            'tanggal_lahir' => 'Tanggal Lahir',
            'nik' => 'Nik',
            'create_by' => 'Create By',
            'create_time_at' => 'Create Time At',
            'update_by' => 'Update By',
            'update_time_at' => 'Update Time At',
        ];
    }

    /**
     * Gets query for [[DataForms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDataForms()
    {
        return $this->hasMany(DataForm::class, ['id_registrasi' => 'id_registrasi']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $now = date('Y-m-d H:i:s');
            if ($this->isNewRecord) {
                $this->create_time_at = $now;
                $this->create_by = Yii::$app->user->id ?? 0;
            }
            $this->update_time_at = $now;
            $this->update_by = Yii::$app->user->id ?? 0;
            return true;
        } else {
            return false;
        }
    }
}
