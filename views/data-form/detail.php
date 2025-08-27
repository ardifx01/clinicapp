<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;


// Pastikan Anda sudah mendeklarasikan variabel $registrasi di bagian ini
/** @var app\models\DataRegistrasi $registrasi */


$this->title = $model->isNewRecord ? 'Input Form Pengkajian Keperawatan' : 'Detail Data Formulir';
$this->params['breadcrumbs'][] = ['label' => 'Data Formulir', 'url' => ['data-form/index']];
$this->params['breadcrumbs'][] = $this->title;

// Variabel untuk memudahkan akses data JSON yang sudah ada
$data = $formData;

// Definisi mapping untuk nilai-nilai yang dikodekan (seperti 'a', 'b', dll.)
$mappings = require(__DIR__ . '/../../config/mappings.php');
?>

<div class="data-form-detail">

    <div class="data-form-simple">

        <h1><?= Html::encode($this->title) ?></h1>
        <p>
            <?= Html::a('Kembali ke Daftar', ['index'], ['class' => 'btn btn-secondary']) ?>
            <?= Html::a('Cetak Formulir', Url::to(['data-form/print', 'id_form_data' => $model->id_form_data]), [
                'class' => 'btn btn-info',
                'target' => '_blank', // Buka di tab baru
            ]) ?>
        </p>

        <div class="alert alert-info">
            <strong>Pasien:</strong> <?= Html::encode($registrasi->nama_pasien) ?> || <?= Html::encode($registrasi->nik) ?> <br>
            <strong>Tanggal Lahir</strong> <?= Html::encode($registrasi->tanggal_lahir) ?> <br>

            <strong>No. Registrasi:</strong> <?= Html::encode($registrasi->no_registrasi) ?> <br>
            <strong>No. Rekam Medis:</strong> <?= Html::encode($registrasi->no_rekam_medis) ?> <br>
            <strong>Tanggal :</strong> <?= Html::encode($registrasi->update_time_at) ?> 

        </div>
    </div>
    <h4>Detail Pengkajian</h4>

    <?php
    // Siapkan array untuk DetailView
    $detailAttributes = [];
    foreach ($formData as $key => $value) {
        // Logika untuk menampilkan nilai yang sudah di-mapping
        $mappedValue = $value;
        if (isset($mappings[$key]) && isset($mappings[$key][$value])) {
            $mappedValue = $mappings[$key][$value];
        }

        $detailAttributes[] = [
            'label' => ucwords(str_replace('_', ' ', $key)),
            'value' => $mappedValue,
        ];
    }

    // Tampilkan data pengkajian dalam format DetailView
    echo DetailView::widget([
        'model' => $formData, // Gunakan array $formData sebagai model
        'attributes' => $detailAttributes,
    ]);
    ?>
    

</div>