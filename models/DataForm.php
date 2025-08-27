<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "data_form".
 *
 * @property int $id_form_data
 * @property int|null $id_form
 * @property int|null $id_registrasi
 * @property string|null $data
 * @property bool|null $is_delete
 * @property int|null $create_by
 * @property int|null $update_by
 * @property string|null $create_time_at
 * @property string|null $update_time_at
 *
 * @property DataRegistrasi $registrasi
 */
class DataForm extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_form';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_form', 'id_registrasi', 'data', 'is_delete', 'create_by', 'update_by', 'create_time_at', 'update_time_at'], 'default', 'value' => null],
            // [['id_form_data'], 'required'],
            // [['id_form_data', 'id_form', 'id_registrasi', 'create_by', 'update_by'], 'default', 'value' => null],
            [['id_form_data', 'id_form', 'id_registrasi', 'create_by', 'update_by'], 'integer'],
            [['data', 'create_time_at', 'update_time_at'], 'safe'],
            [['is_delete'], 'boolean'],
            [['id_form_data'], 'unique'],
            [['id_registrasi'], 'exist', 'skipOnError' => true, 'targetClass' => DataRegistrasi::class, 'targetAttribute' => ['id_registrasi' => 'id_registrasi']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_form_data' => 'Id Form Data',
            'id_form' => 'Id Form',
            'id_registrasi' => 'Id Registrasi',
            'data' => 'Data',
            'is_delete' => 'Is Delete',
            'create_by' => 'Create By',
            'update_by' => 'Update By',
            'create_time_at' => 'Create Time At',
            'update_time_at' => 'Update Time At',
        ];
    }

    /**
     * Gets query for [[Registrasi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegistrasi()
    {
        return $this->hasOne(DataRegistrasi::class, ['id_registrasi' => 'id_registrasi']);
    }

    public function init()
    {
        parent::init();

        // Set nilai default untuk id_form
        if ($this->isNewRecord) {
            $this->id_form = 1; // Atur 1 sebagai default untuk Pengkajian Keperawatan
        }
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Jika rekaman baru, set create_time_at
            if ($this->isNewRecord) {
                $this->create_time_at = date('Y-m-d H:i:s');
            }
            // Selalu set update_time_at saat menyimpan (baik baru atau update)
            $this->update_time_at = date('Y-m-d H:i:s');

            return true;
        } else {
            return false;
        }
    }
}
