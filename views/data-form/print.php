<?php

use yii\helpers\Html;
use app\models\DataRegistrasi;


/* @var $this yii\web\View */
/* @var $model app\models\DataForm */
/* @var $registrasi app\models\DataRegistrasi */
/* @var $formData array */





$data = $formData;
// Mendefinisikan layout untuk print
$this->context->layout = false;

// Fungsi helper untuk mendapatkan nilai dari array formData
function getFormData($formData, $key, $default = '')
{
    return isset($formData[$key]) ? $formData[$key] : $default;
}

// Fungsi helper untuk menentukan apakah sebuah radio button harus dicentang
function isChecked($formData, $key, $value)
{
    return getFormData($formData, $key) == $value ? 'checked' : '';
}

// Menghitung total skor risiko jatuh
$total_score = 0;
// Poin 1
$total_score += isChecked($formData, 'riwayat_jatuh', 'a') == 'checked' ? 25 : 0;
// Poin 2
$total_score += isChecked($formData, 'diagnosa_sekunder', 'a') == 'checked' ? 15 : 0;
// Poin 3
$alat_bantu_jalan_score = 0;
if (isChecked($formData, 'alat_bantu_jalan', 'b') == 'checked' || isChecked($formData, 'alat_bantu_jalan', 'c') == 'checked') {
    $alat_bantu_jalan_score = 15;
}
$total_score += $alat_bantu_jalan_score;
// Poin 4
$total_score += isChecked($formData, 'terapi_heparin', 'a') == 'checked' ? 20 : 0;
// Poin 5
$cara_berjalan_score = 0;
if (isChecked($formData, 'cara_berjalan', 'b') == 'checked') {
    $cara_berjalan_score = 10;
} elseif (isChecked($formData, 'cara_berjalan', 'c') == 'checked') {
    $cara_berjalan_score = 15;
}
$total_score += $cara_berjalan_score;
// Poin 6
$total_score += isChecked($formData, 'status_mental', 'b') == 'checked' ? 15 : 0;

// Menentukan kategori dan intervensi berdasarkan total skor
$kategori_risiko = '';
$intervensi_risiko = '';
if ($total_score >= 0 && $total_score <= 24) {
    $kategori_risiko = 'Risiko Rendah';
    $intervensi_risiko = 'Perawatan Baik';
} elseif ($total_score >= 25 && $total_score <= 44) {
    $kategori_risiko = 'Risiko Sedang';
    $intervensi_risiko = 'Lakukan Intervensi Jatuh Standar';
} elseif ($total_score >= 45) {
    $kategori_risiko = 'Risiko Tinggi';
    $intervensi_risiko = 'Lakukan Intervensi Jatuh Risiko Tinggi';
}

?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="/css/print.css">

<head>
    <title>Print Pengkajian Keperawatan</title>
</head>

<body>

    <div class="print-container">
        <div class="header-section">
            <div class="header-title">
                PENGKAJIAN KEPERAWATAN <br> POLIKLINIK KEBIDANAN
            </div>
            <div class="patient-info">
                <span class="label">Nama Lengkap Pasien</span>: <?= Html::encode($registrasi->nama_pasien) ?><br>
                <span class="label">Tanggal Lahir</span>: <?= Html::encode(Yii::$app->formatter->asDate($registrasi->tanggal_lahir, 'php:d/m/Y')) ?><br>
                <span class="label">No. Rekam Medis</span>: <?= Html::encode($registrasi->no_rekam_medis) ?>
            </div>
        </div>

        <table class="patient-info info-table">
            <tr>
                <td style="width: 50%;">
                    <span class="label">Tanggal Pengkajian</span>: <?= Html::encode(Yii::$app->formatter->asDate($model->create_time_at, 'php:d/m/Y')) ?><br>
                    <span class="label">Jam Pengkajian</span>: <?= Html::encode(Yii::$app->formatter->asTime($model->create_time_at, 'php:H:i')) ?><br>
                    <span class="label">Poliklinik</span>: KLINIK OBGYN
                </td>
            </tr>
        </table>

        <div class="section-header">Pengkajian Saat Datang (Diisi Oleh Perawat)</div>


        <div class="content-item ">
            1. Cara Masuk:
            <span class="label">
                <label class="radio-label"><input type="radio" name="cara_masuk" <?= isChecked($formData, 'cara_masuk', 'a') ?> disabled> Jalan tanpa bantuan</label>
                <label class="radio-label"><input type="radio" name="cara_masuk" <?= isChecked($formData, 'cara_masuk', 'b') ?> disabled> Kursi tanpa bantuan</label>
                <label class="radio-label"><input type="radio" name="cara_masuk" <?= isChecked($formData, 'cara_masuk', 'c') ?> disabled> Tempat tidur dorong</label>
                <label class="radio-label"><input type="radio" name="cara_masuk" <?= isChecked($formData, 'cara_masuk', 'd') ?> disabled> Lain-lain</label>
            </span> <br>

        </div>

        <div class="content-item">
            2. Anamnesis:
            <label class="radio-label"><input type="radio" name="anamnesis" <?= isChecked($formData, 'anamnesis', 'a') ?> disabled> Autoanamnesis</label>
            <label class="radio-label"><input type="radio" name="anamnesis" <?= isChecked($formData, 'anamnesis', 'b') ?> disabled> Aloanamnesis</label>
            Diperoleh: <span class="underline"><?= Html::encode(getFormData($formData, 'diperoleh')) ?></span>
            Hubungan: <span class="underline"><?= Html::encode(getFormData($formData, 'hubungan')) ?></span>
            Alergi: <span class="underline"><?= Html::encode(getFormData($formData, 'alergi')) ?></span>
        </div>

        <div class="content-item">
            3. Keluhan utama saat ini: <span class="underline"><?= Html::encode(getFormData($formData, 'keluhan')) ?></span>
        </div>

        <div class="content-item">
            4. Pemeriksaan Fisik:
            <br>a. Keadaan Umum:
            <label class="radio-label"><input type="radio" name="keadaan_umum" <?= isChecked($formData, 'keadaan_umum', 'a') ?> disabled> Tidak tampak sakit</label>
            <label class="radio-label"><input type="radio" name="keadaan_umum" <?= isChecked($formData, 'keadaan_umum', 'b') ?> disabled> Sakit Ringan</label>
            <label class="radio-label"><input type="radio" name="keadaan_umum" <?= isChecked($formData, 'keadaan_umum', 'c') ?> disabled> Sedang</label>
            <label class="radio-label"><input type="radio" name="keadaan_umum" <?= isChecked($formData, 'keadaan_umum', 'd') ?> disabled> Berat</label>
            <br>
            b. Warna Kulit:
            <label class="radio-label"><input type="radio" name="warna_kulit" <?= isChecked($formData, 'warna_kulit', 'a') ?> disabled> Normal</label>
            <label class="radio-label"><input type="radio" name="warna_kulit" <?= isChecked($formData, 'warna_kulit', 'b') ?> disabled> Sianosis</label>
            <label class="radio-label"><input type="radio" name="warna_kulit" <?= isChecked($formData, 'warna_kulit', 'c') ?> disabled> Pucat</label>
            <label class="radio-label"><input type="radio" name="warna_kulit" <?= isChecked($formData, 'warna_kulit', 'd') ?> disabled> Kemerahan</label>
            <br>
            <table style="width: 100%; border-collapse: collapse; margin-top: 10px; border:1px, solid">
                <tr>
                    <td style="width: 25%; vertical-align: top; border:1px, solid">
                        <div class="content-item">
                            Kesadaran: <br>
                            <label class="radio-label"><input type="radio" name="kesadaran" <?= isChecked($formData, 'kesadaran', 'a') ?> disabled> Compos Mentis</label><br>
                            <label class="radio-label"><input type="radio" name="kesadaran" <?= isChecked($formData, 'kesadaran', 'b') ?> disabled> Apatis</label><br>
                            <label class="radio-label"><input type="radio" name="kesadaran" <?= isChecked($formData, 'kesadaran', 'c') ?> disabled> Somnolent</label><br>
                            <label class="radio-label"><input type="radio" name="kesadaran" <?= isChecked($formData, 'kesadaran', 'd') ?> disabled> Sopor</label><br>
                            <label class="radio-label"><input type="radio" name="kesadaran" <?= isChecked($formData, 'kesadaran', 'e') ?> disabled> Soporokoma</label><br>
                            <label class="radio-label"><input type="radio" name="kesadaran" <?= isChecked($formData, 'kesadaran', 'f') ?> disabled> Koma</label><br>
                        </div>
                    </td>
                    <td style="width: 25%; vertical-align: top; border:1px, solid">
                        <div class="content-item">
                            Tanda Vital:
                            <br>TD (mmHg): <span class="underline"><?= Html::encode(getFormData($formData, 'td_mm')) ?>/<?= Html::encode(getFormData($formData, 'td_Hg')) ?> mmHg</span>
                            <br>P (x/menit): <span class="underline"><?= Html::encode(getFormData($formData, 'p')) ?> x/menit</span>
                            <br>N (x/menit): <span class="underline"><?= Html::encode(getFormData($formData, 'n')) ?> x/menit</span>
                            <br>S (oC): <span class="underline"><?= Html::encode(getFormData($formData, 's')) ?> &#8451;</span>
                        </div>
                    </td>
                    <td style="width: 25%; vertical-align: top; border:1px, solid">
                        <div class="content-item">
                            Fungsional: 
                            <br>Alat Bantu: <span class="underline"><?= Html::encode(getFormData($formData, 'alat_bantu')) ?></span>
                            <br>Protesa: <span class="underline"><?= Html::encode(getFormData($formData, 'prothesa')) ?></span>
                            <br>ADL:
                            <br><label class="radio-label"><input type="radio" name="adl" <?= isChecked($formData, 'adl', 'a') ?> disabled> Mandiri</label>
                            <br><label class="radio-label"><input type="radio" name="adl" <?= isChecked($formData, 'adl', 'b') ?> disabled> Dibantu</label>
                            <br>
                            <br>Riwayat Jatuh:
                            <br><label class="radio-label"><input type="radio" name="riwayat_jatuh_fungsional" <?= isChecked($formData, 'riwayat_jatuh_fungsional', 'a') ?> disabled> + </label>
                            <br><label class="radio-label"><input type="radio" name="riwayat_jatuh_fungsional" <?= isChecked($formData, 'riwayat_jatuh_fungsional', 'b') ?> disabled> - </label>
                            <!-- <br>Riwayat Jatuh: <span class="underline"><?= Html::encode(getFormData($formData, 'riwayat_jatuh_fungsional')) ?></span> -->
                        </div>
                    </td>
                    <td style="width: 25%; vertical-align: top;">
                        <div class="content-item">
                            Antrapometri: 
                            <br>Berat Badan : <span class="underline"><?= Html::encode(getFormData($formData, 'berat_badan')) ?> Kg</span>
                            <br>Tinggi Badan : <span class="underline"><?= Html::encode(getFormData($formData, 'tinggi_badan')) ?> Cm</span>
                            <br>Panjang Badan (PB): <span class="underline"><?= Html::encode(getFormData($formData, 'panjang_badan')) ?> Cm</span>
                            <br>Lingkar Kepala (LK): <span class="underline"><?= Html::encode(getFormData($formData, 'lingkar_kepala')) ?> Cm</span>
                            <br>IMT: <span class="underline"><?= Html::encode(getFormData($formData, 'imt_value')) ?> | <?= Html::encode(getFormData($formData, 'imt_status')) ?></span>
                        </div>
                    </td>
                </tr>
            </table>

            <br>c. Status Gizi:
            <label class="radio-label"><input type="radio" name="imt_status" <?= isChecked($formData, 'imt_status', 'Kurus') ?> disabled> Kurus</label>
            <label class="radio-label"><input type="radio" name="imt_status" <?= isChecked($formData, 'imt_status', 'Normal') ?> disabled> Normal</label>
            <label class="radio-label"><input type="radio" name="imt_status" <?= isChecked($formData, 'imt_status', 'Gemuk') ?> disabled> Gemuk</label>
            <label class="radio-label"><input type="radio" name="imt_status" <?= isChecked($formData, 'imt_status', 'Obesitas') ?> disabled> Obesitas</label>
        </div>

        <div class="content-item">
            5. Riwayat Penyakit Sekarang: <span class="underline"><?= Html::encode(getFormData($formData, 'riwayat_penyakit_sekarang')) ?></span>
        </div>
        <div class="content-item">
            6. Riwayat Penyakit Sebelumnya:
            <label class="radio-label"><input type="radio" name="riwayat_penyakit_sebelumnya" <?= isChecked($formData, 'riwayat_penyakit_sebelumnya', 'a') ?> disabled> DM</label>
            <label class="radio-label"><input type="radio" name="riwayat_penyakit_sebelumnya" <?= isChecked($formData, 'riwayat_penyakit_sebelumnya', 'b') ?> disabled> Hipertensi</label>
            <label class="radio-label"><input type="radio" name="riwayat_penyakit_sebelumnya" <?= isChecked($formData, 'riwayat_penyakit_sebelumnya', 'c') ?> disabled> Jantung</label>
            <label class="radio-label"><input type="radio" name="riwayat_penyakit_sebelumnya" <?= isChecked($formData, 'riwayat_penyakit_sebelumnya', 'd') ?> disabled> Lain-lain</label>
        </div>
        <div class="content-item">
            7. Riwayat Penyakit :
            <label class="radio-label"><input type="radio" name="riwayat_penyakit" <?= isChecked($formData, 'riwayat_penyakit', 'a') ?> disabled> Ya</label>
            <label class="radio-label"><input type="radio" name="riwayat_penyakit" <?= isChecked($formData, 'riwayat_penyakit', 'b') ?> disabled> Tidak</label>
        </div>
        <div class="content-item">
            8. Riwayat Penyakit Keluarga: <span class="underline"><?= Html::encode(getFormData($formData, 'riwayat_penyakit_keluarga')) ?></span>
        </div>
        <div class="content-item">
            9. Riwayat Operasi:
            <label class="radio-label"><input type="radio" name="riwayat_operasi" <?= isChecked($formData, 'riwayat_operasi', 'a') ?> disabled> Ya</label>
            <label class="radio-label"><input type="radio" name="riwayat_operasi" <?= isChecked($formData, 'riwayat_operasi', 'b') ?> disabled> Tidak</label>
            <br> Operasi Apa : <span class="underline"><?= Html::encode(getFormData($formData, 'operasi_apa')) ?></span> Kapan : <span class="underline"><?= Html::encode(getFormData($formData, 'kapan_operasi')) ?></span>
        </div>
        <div class="content-item">
            10. Riwayat Pernah Dirawat di RS:
            <label class="radio-label"><input type="radio" name="riwayat_rawat" <?= isChecked($formData, 'riwayat_rawat', 'a') ?> disabled> Ya</label>
            <label class="radio-label"><input type="radio" name="riwayat_rawat" <?= isChecked($formData, 'riwayat_rawat', 'b') ?> disabled> Tidak</label>
            <br> Kapan : <span class="underline"><?= Html::encode(Yii::$app->formatter->asDate(getFormData($formData, 'kapan_rawat'), 'php:d/m/Y')) ?></span>
        </div>

        <div class="section-header">15. Pengkajian Risiko Jatuh</div>
        <table class="risk-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Risiko</th>
                    <th>Skala</th>
                    <th>Hasil</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Riwayat jatuh yang baru atau dalam 3 bulan terakhir</td>
                    <td>Tidak = 0<br>Ya = 25</td>
                    <td><?= isChecked($formData, 'riwayat_jatuh', 'a') == 'checked' ? '25' : '0' ?></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Diagnosa Medis Sekunder > 1</td>
                    <td>Tidak = 0<br>Ya = 15</td>
                    <td><?= isChecked($formData, 'diagnosa_sekunder', 'a') == 'checked' ? '15' : '0' ?></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Alat bantu jalan</td>
                    <td>Mandiri, Bed Rest, Dibantu Perawat, Kursi Roda = 0<br>Penopang, Tongkat/ Walker = 15<br>Mencengkram Furniture/ Sesuatu Untuk Topangan = 15</td>
                    <td><?= $alat_bantu_jalan_score ?></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Ad Akses IV atau terapi Heparin Lock</td>
                    <td>Tidak = 0<br>Ya = 20</td>
                    <td><?= isChecked($formData, 'terapi_heparin', 'a') == 'checked' ? '20' : '0' ?></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Cara Berjalan/Berpindah</td>
                    <td>Normal = 0<br>Lemah, Langkah, Diseret = 10<br>Terganggu, Perlu Bantuan, Keseimbangan Buruk = 15</td>
                    <td><?= $cara_berjalan_score ?></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Status Mental</td>
                    <td>Orientasi Sesuai Kemampuan Diri = 0<br>Lupa Keterbatasan Diri = 15</td>
                    <td><?= isChecked($formData, 'status_mental', 'b') == 'checked' ? '15' : '0' ?></td>
                </tr>
                <tr style="columns: 3;">
                    <td></td>
                    <td></td>
                    <td>Total</td>
                    <td><b><?= $total_score ?></b></td>
                </tr>
            </tbody>

        </table>
        <div class="notes-box page-break-before">
            <div class="left">
                <h5>Catatan</h5>
                Nilai Total: <span class="underline"><?= $total_score ?></span><br>
                Kategori Risiko: <span class="underline"><?= $kategori_risiko ?></span>
            </div>
            <div class="right">
                <h5>Intervensi</h5>
                <span class="underline"><?= $intervensi_risiko ?></span>
            </div>
        </div>

        <div class="left">
            <table style="width: 50%; border-collapse: collapse; margin-top: 20px;">
                <tr>
                    <td style="border: 1px solid black; padding: 5px; text-align: center;">
                        <p style="font-weight: bold; margin-bottom: 5px;">Petugas</p>
                        <table style="width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 10pt;">
                            <tr>
                                <td style="width: 50%; padding: 5px; border: 1px solid black;">Tanggal / Pukul</td>
                                <td style="width: 50%; padding: 5px; border: 1px solid black;"><?= Html::encode(Yii::$app->formatter->asDatetime($model->create_time_at, 'php:d/m/Y, H:i')) ?></td>
                            </tr>
                            <tr>
                                <td style="width: 50%; padding: 5px; border: 1px solid black;">Nama Lengkap</td>
                                <td style="width: 50%; padding: 5px; border: 1px solid black;"></td>
                            </tr>
                            <tr>
                                <td style="width: 50%; padding: 5px; border: 1px solid black;">Tanda Tangan</td>
                                <td class="signature-cell" style="width: 50%; padding: 5px; border: 1px solid black;">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        <p style="text-align: center; margin-top: 30px;" class="no-print">
            <button onclick="window.print();" class="btn btn-primary">Cetak Halaman Ini</button>
        </p>
</body>

</html>