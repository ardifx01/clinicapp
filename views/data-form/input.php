<?php

use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\DataForm $model */
/** @var app\models\DataRegistrasi $registrasi */
/** @var array $formData Data yang sudah di-parse dari JSON */

$this->title = $model->isNewRecord ? 'Input Form Pengkajian Keperawatan' : 'Edit Form Pengkajian Keperawatan';
$this->params['breadcrumbs'][] = ['label' => 'Data Registrasi', 'url' => ['data-registrasi/index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('@web/js/main.js', ['depends' => [JqueryAsset::class]]);

$data = $formData;
?>

<div class="data-form-simple">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="alert alert-info">
        <strong>Pasien :</strong> <?= Html::encode($registrasi->nama_pasien) ?> <br>
        <strong>No Registrasi :</strong> <?= Html::encode($registrasi->no_registrasi) ?> <br>
        <strong>No Rekam Medis : </strong> <?= Html::encode($registrasi->no_rekam_medis) ?>
    </div>

    <?php $form = ActiveForm::begin(); ?>
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">1. Cara Masuk</h5>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <?php
                $options = [
                    'a' => 'Jalan Tanpa Bantuan',
                    'b' => 'Kursi Tanpa Bantuan',
                    'c' => 'Tempat Tidur Dorong',
                    'd' => 'Lain-lain'
                ];
                echo Html::radioList('FormData[cara_masuk]', $data['cara_masuk'] ?? null, $options, [
                    'class' => 'd-flex flex-wrap', // Gunakan flexbox untuk tata letak horizontal
                    'item' => function ($index, $label, $name, $checked, $value) {
                        return '<div class="form-check me-4">' .
                            Html::radio($name, $checked, [
                                'value' => $value,
                                'class' => 'form-check-input',
                                'id' => 'cara_masuk_' . $index
                            ]) .
                            Html::label($label, 'cara_masuk_' . $index, [
                                'class' => 'form-check-label'
                            ]) .
                            '</div>';
                    },
                ]);
                ?>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">2. Anamnesis</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <?php
                $options = [
                    'a' => 'Autoanamnesis',
                    'b' => 'Aloanamnesis',
                ];
                echo Html::radioList('FormData[anamnesis]', $data['anamnesis'] ?? null, $options, [
                    'class' => 'd-flex flex-wrap',
                    'item' => function ($index, $label, $name, $checked, $value) {
                        return '<div class="form-check me-4">' .
                            Html::radio($name, $checked, [
                                'value' => $value,
                                'class' => 'form-check-input',
                                'id' => 'anamnesis_' . $index
                            ]) .
                            Html::label($label, 'anamnesis_' . $index, [
                                'class' => 'form-check-label'
                            ]) .
                            '</div>';
                    },
                ]);
                ?>
            </div>
            
            <div class="row">
                <div class="col-md-3">
                    <label class="form-label">Diperoleh</label>
                    <input type="text" class="form-control" name="FormData[diperoleh]" value="<?= Html::encode($data['diperoleh'] ?? '') ?>" placeholder="Diperoleh Dari">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Hubungan</label>
                    <input type="text" class="form-control" name="FormData[hubungan]" value="<?= Html::encode($data['hubungan'] ?? '') ?>" placeholder="Hubungan">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Alergi</label>
                    <input type="text" class="form-control" name="FormData[alergi]" value="<?= Html::encode($data['alergi'] ?? '') ?>" placeholder="Apakah Ada Alergi">
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">3. Keluhan Saat Ini</h5>
        </div>
        <div class="card-body">
            <input type="text" class="form-control" name="FormData[keluhan]" value="<?= Html::encode($data['keluhan'] ?? '') ?>" placeholder="Keluhan Saat Ini">
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">4. Pemeriksaan Fisik</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label fw-bold">a. Keadaan Umum</label>
                <?php
                $options = [
                    'a' => 'Tidak Tampak Sakit',
                    'b' => 'Sakit Ringan',
                    'c' => 'Sedang',
                    'd' => 'Berat',
                ];
                echo Html::radioList('FormData[keadaan_umum]', $data['keadaan_umum'] ?? null, $options, [
                    'class' => 'd-flex flex-wrap',
                    'item' => function ($index, $label, $name, $checked, $value) {
                        return '<div class="form-check me-4">' .
                            Html::radio($name, $checked, [
                                'value' => $value,
                                'class' => 'form-check-input',
                                'id' => 'keadaan_umum_' . $index
                            ]) .
                            Html::label($label, 'keadaan_umum_' . $index, [
                                'class' => 'form-check-label'
                            ]) .
                            '</div>';
                    },
                ]);
                ?>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">b. Warna Kulit</label>
                <?php
                $options = [
                    'a' => 'Normal',
                    'b' => 'Sianosis',
                    'c' => 'Pucat',
                    'd' => 'Kemerahan',
                ];
                echo Html::radioList('FormData[warna_kulit]', $data['warna_kulit'] ?? null, $options, [
                    'class' => 'd-flex flex-wrap',
                    'item' => function ($index, $label, $name, $checked, $value) {
                        return '<div class="form-check me-4">' .
                            Html::radio($name, $checked, [
                                'value' => $value,
                                'class' => 'form-check-input',
                                'id' => 'warna_kulit_' . $index
                            ]) .
                            Html::label($label, 'warna_kulit_' . $index, [
                                'class' => 'form-check-label'
                            ]) .
                            '</div>';
                    },
                ]);
                ?>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kesadaran</label>
                        <?php
                        $options = [
                            'a' => 'Compos Mentis',
                            'b' => 'Apatis',
                            'c' => 'Somnolent',
                            'd' => 'Sopor',
                            'e' => 'Soporokoma',
                            'f' => 'Koma',
                        ];
                        echo Html::radioList('FormData[kesadaran]', $data['kesadaran'] ?? null, $options, [
                            'class' => 'd-flex flex-wrap',
                            'item' => function ($index, $label, $name, $checked, $value) {
                                return '<div class="form-check me-4">' .
                                    Html::radio($name, $checked, [
                                        'value' => $value,
                                        'class' => 'form-check-input',
                                        'id' => 'kesadaran_' . $index
                                    ]) .
                                    Html::label($label, 'kesadaran_' . $index, [
                                        'class' => 'form-check-label'
                                    ]) .
                                    '</div>';
                            },
                        ]);
                        ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanda Vital</label>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">TD (mm)</label>
                                <input type="text" class="form-control" name="FormData[td_mm]" value="<?= Html::encode($data['td_mm'] ?? '') ?>" placeholder="Tekanan Darah (mm)">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">TD (Hg)</label>
                                <input type="text" class="form-control" name="FormData[td_Hg]" value="<?= Html::encode($data['td_Hg'] ?? '') ?>" placeholder="Tekanan Darah (Hg)">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">P</label>
                                <input type="text" class="form-control" name="FormData[p]" value="<?= Html::encode($data['p'] ?? '') ?>" placeholder="Pernapasan">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">N</label>
                                <input type="text" class="form-control" name="FormData[n]" value="<?= Html::encode($data['n'] ?? '') ?>" placeholder="Nadi">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">S</label>
                                <input type="text" class="form-control" name="FormData[s]" value="<?= Html::encode($data['s'] ?? '') ?>" placeholder="Suhu">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Fungsional</label>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Alat Bantu</label>
                                <input type="text" class="form-control" name="FormData[alat_bantu]" value="<?= Html::encode($data['alat_bantu'] ?? '') ?>" placeholder="Alat Bantu">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Prothesa</label>
                                <input type="text" class="form-control" name="FormData[prothesa]" value="<?= Html::encode($data['prothesa'] ?? '') ?>" placeholder="Prothesa">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Cacat Tubuh</label>
                                <input type="text" class="form-control" name="FormData[cacat]" value="<?= Html::encode($data['cacat'] ?? '') ?>" placeholder="Cacat Tubuh">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">ADL</label>
                                <?php
                                $options = [
                                    'a' => 'Mandiri',
                                    'b' => 'Dibantu',
                                ];
                                echo Html::radioList('FormData[adl]', $data['adl'] ?? null, $options, [
                                    'class' => 'd-flex flex-wrap',
                                    'item' => function ($index, $label, $name, $checked, $value) {
                                        return '<div class="form-check me-4">' .
                                            Html::radio($name, $checked, [
                                                'value' => $value,
                                                'class' => 'form-check-input',
                                                'id' => 'adl_' . $index
                                            ]) .
                                            Html::label($label, 'adl_' . $index, [
                                                'class' => 'form-check-label'
                                            ]) .
                                            '</div>';
                                    },
                                ]);
                                ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Riwayat Jatuh</label>
                                <?php
                                $options = [
                                    'a' => '+',
                                    'b' => '-',
                                ];
                                echo Html::radioList('FormData[riwayat_jatuh_fungsional]', $data['riwayat_jatuh_fungsional'] ?? null, $options, [
                                    'class' => 'd-flex flex-wrap',
                                    'item' => function ($index, $label, $name, $checked, $value) {
                                        return '<div class="form-check me-4">' .
                                            Html::radio($name, $checked, [
                                                'value' => $value,
                                                'class' => 'form-check-input',
                                                'id' => 'riwayat_jatuh_fungsional_' . $index
                                            ]) .
                                            Html::label($label, 'riwayat_jatuh_fungsional_' . $index, [
                                                'class' => 'form-check-label'
                                            ]) .
                                            '</div>';
                                    },
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Antropometri</label>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Berat Badan (Kg)</label>
                                <input type="number" step="0.1" class="form-control" id="berat_badan" name="FormData[berat_badan]" value="<?= Html::encode($data['berat_badan'] ?? '') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tinggi Badan (cm)</label>
                                <input type="number" step="0.1" class="form-control" id="tinggi_badan" name="FormData[tinggi_badan]" value="<?= Html::encode($data['tinggi_badan'] ?? '') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Lingkar Kepala (cm)</label>
                                <input type="number" step="0.1" class="form-control" name="FormData[lingkar_kepala]" value="<?= Html::encode($data['lingkar_kepala'] ?? '') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Panjang Badan (cm)</label>
                                <input type="number" step="0.1" class="form-control" name="FormData[panjang_badan]" value="<?= Html::encode($data['panjang_badan'] ?? '') ?>">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">IMT (kg/m²):</label>
                                <span id="imt_result" class="fw-bold">0</span> | <span id="imt_status">--</span>
                                <input type="hidden" id="imt_value_hidden" name="FormData[imt_value]" value="<?= Html::encode($data['imt_value'] ?? '') ?>">
                                <input type="hidden" id="imt_status_hidden" name="FormData[imt_status]" value="<?= Html::encode($data['imt_status'] ?? '') ?>">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Lingkar Perut (cm):</label>
                                <input type="number" step="0.1" class="form-control" name="FormData[lingkar_perut]" value="<?= Html::encode($data['lingkar_perut'] ?? '') ?>">
                                <small class="form-text text-muted">L > 90cm, P > 80cm</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">5. Riwayat Penyakit Sekarang</h5>
        </div>
        <div class="card-body">
            <input type="text" class="form-control" name="FormData[riwayat_penyakit_sekarang]" value="<?= Html::encode($data['riwayat_penyakit_sekarang'] ?? '') ?>" placeholder="Riwayat Penyakit Sekarang">
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">6. Riwayat Penyakit Sebelumnya</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <?php
                $options = [
                    'a' => 'DM',
                    'b' => 'Hipertensi',
                    'c' => 'Jantung',
                    'd' => 'Lain-lain',
                ];
                echo Html::radioList('FormData[riwayat_penyakit_sebelumnya]', $data['riwayat_penyakit_sebelumnya'] ?? null, $options, [
                    'class' => 'd-flex flex-wrap',
                    'item' => function ($index, $label, $name, $checked, $value) {
                        return '<div class="form-check me-4">' .
                            Html::radio($name, $checked, [
                                'value' => $value,
                                'class' => 'form-check-input',
                                'id' => 'riwayat_penyakit_sebelumnya_' . $index
                            ]) .
                            Html::label($label, 'riwayat_penyakit_sebelumnya_' . $index, [
                                'class' => 'form-check-label'
                            ]) .
                            '</div>';
                    },
                ]);
                ?>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">7. Riwayat Penyakit Sebelumnya</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <?php
                $options = [
                    'a' => 'Ya',
                    'b' => 'Tidak',
                ];
                echo Html::radioList('FormData[riwayat_penyakit]', $data['riwayat_penyakit'] ?? null, $options, [
                    'class' => 'd-flex flex-wrap',
                    'item' => function ($index, $label, $name, $checked, $value) {
                        return '<div class="form-check me-4">' .
                            Html::radio($name, $checked, [
                                'value' => $value,
                                'class' => 'form-check-input',
                                'id' => 'riwayat_penyakit_' . $index
                            ]) .
                            Html::label($label, 'riwayat_penyakit_' . $index, [
                                'class' => 'form-check-label'
                            ]) .
                            '</div>';
                    },
                ]);
                ?>
            </div>

            <div id="riwayat-penyakit-tambahan" style="<?= (($data['riwayat_penyakit'] ?? '') == 'a') ? '' : 'display:none;' ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Penyakit Apa?</label>
                            <input type="text" class="form-control" name="FormData[penyakit_apa]" value="<?= Html::encode($data['penyakit_apa'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Kapan?</label>
                            <input type="text" class="form-control" name="FormData[kapan_penyakit]" value="<?= Html::encode($data['kapan_penyakit'] ?? '') ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">8. Riwayat Penyakit Keluarga</h5>
        </div>
        <div class="card-body">
            <input type="text" class="form-control" name="FormData[riwayat_penyakit_keluarga]" value="<?= Html::encode($data['riwayat_penyakit_keluarga'] ?? '') ?>" placeholder="Riwayat Penyakit Keluarga">
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">9. Riwayat Operasi</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <?php
                $options = [
                    'a' => 'Ya',
                    'b' => 'Tidak',
                ];
                echo Html::radioList('FormData[riwayat_operasi]', $data['riwayat_operasi'] ?? null, $options, [
                    'class' => 'd-flex flex-wrap',
                    'item' => function ($index, $label, $name, $checked, $value) {
                        return '<div class="form-check me-4">' .
                            Html::radio($name, $checked, [
                                'value' => $value,
                                'class' => 'form-check-input',
                                'id' => 'riwayat_operasi_' . $index
                            ]) .
                            Html::label($label, 'riwayat_operasi_' . $index, [
                                'class' => 'form-check-label'
                            ]) .
                            '</div>';
                    },
                ]);
                ?>
            </div>
            <div id="riwayat-operasi-tambahan" style="<?= (($data['riwayat_operasi'] ?? '') == 'a') ? '' : 'display:none;' ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Operasi Apa?</label>
                            <input type="text" class="form-control" name="FormData[operasi_apa]" value="<?= Html::encode($data['operasi_apa'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Kapan?</label>
                            <input type="text" class="form-control" name="FormData[kapan_operasi]" value="<?= Html::encode($data['kapan_operasi'] ?? '') ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">10. Riwayat Pernah Dirawat Di Rumah Sakit</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <?php
                $options = [
                    'a' => 'Ya',
                    'b' => 'Tidak',
                ];
                echo Html::radioList('FormData[riwayat_rawat]', $data['riwayat_rawat'] ?? null, $options, [
                    'class' => 'd-flex flex-wrap',
                    'item' => function ($index, $label, $name, $checked, $value) {
                        return '<div class="form-check me-4">' .
                            Html::radio($name, $checked, [
                                'value' => $value,
                                'class' => 'form-check-input',
                                'id' => 'riwayat_rawat_' . $index
                            ]) .
                            Html::label($label, 'riwayat_rawat_' . $index, [
                                'class' => 'form-check-label'
                            ]) .
                            '</div>';
                    },
                ]);
                ?>
            </div>
            <div id="riwayat-rawat-tambahan" style="<?= (($data['riwayat_rawat'] ?? '') == 'a') ? '' : 'display:none;' ?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Kapan?</label>
                            <input type="date" class="form-control" name="FormData[kapan_rawat]" value="<?= Html::encode($data['kapan_rawat'] ?? '') ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">11. Pengkajian Risiko Jatuh</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label fw-bold">1. Riwayat Jatuh Yang Baru Atau Dalam 3 Bulan Terakhir</label>
                <?php
                $options = [
                    'a' => 'Ya',
                    'b' => 'Tidak',
                ];
                echo Html::radioList('FormData[riwayat_jatuh]', $data['riwayat_jatuh'] ?? null, $options, [
                    'class' => 'd-flex flex-wrap',
                    'item' => function ($index, $label, $name, $checked, $value) {
                        $score = ($value == 'a') ? 25 : 0;
                        return '<div class="form-check me-4">' .
                            Html::radio($name, $checked, [
                                'value' => $value,
                                'class' => 'form-check-input risk-score',
                                'data-score' => $score,
                                'id' => 'riwayat_jatuh_' . $index
                            ]) .
                            Html::label($label, 'riwayat_jatuh_' . $index, [
                                'class' => 'form-check-label'
                            ]) .
                            '</div>';
                    },
                ]);
                ?>
            </div>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <label class="form-label fw-bold">2. Diagnosa Medis Sekunder > 1</label>
                <?php
                $options = [
                    'a' => 'Ya',
                    'b' => 'Tidak',
                ];
                echo Html::radioList('FormData[diagnosa_sekunder]', $data['diagnosa_sekunder'] ?? null, $options, [
                    'class' => 'd-flex flex-wrap',
                    'item' => function ($index, $label, $name, $checked, $value) {
                        $score = ($value == 'a') ? 15 : 0;
                        return '<div class="form-check me-4">' .
                            Html::radio($name, $checked, [
                                'value' => $value,
                                'class' => 'form-check-input risk-score',
                                'data-score' => $score,
                                'id' => 'diagnosa_sekunder_' . $index
                            ]) .
                            Html::label($label, 'diagnosa_sekunder_' . $index, [
                                'class' => 'form-check-label'
                            ]) .
                            '</div>';
                    },
                ]);
                ?>
            </div>
        </div>

        <div class="card-body">
            <div class="mb-6">
                <label class="form-label fw-bold">3. Alat Bantu Jalan</label>
                <?php
                $options = [
                    'a' => 'Mandiri, Bed Rest, Dibantu Perawat, Kursi Roda',
                    'b' => 'Penopang, Tongkat/ Walker',
                    'c' => 'Mencengkram Furniture/ Sesuatu Untuk Topangan',
                ];
                echo Html::radioList('FormData[alat_bantu_jalan]', $data['alat_bantu_jalan'] ?? null, $options, [
                    'class' => 'd-flex flex-wrap',
                    'item' => function ($index, $label, $name, $checked, $value) {
                        $scores = [
                            'a' => 0,
                            'b' => 15,
                            'c' => 15,
                        ];
                        $score = $scores[$value] ?? 0;

                        return '<div class="form-check me-4">' .
                            Html::radio($name, $checked, [
                                'value' => $value,
                                'class' => 'form-check-input risk-score',
                                'data-score' => $score,
                                'id' => 'alat_bantu_jalan_' . $index
                            ]) .
                            Html::label($label, 'alat_bantu_jalan_' . $index, [
                                'class' => 'form-check-label'
                            ]) .
                            '</div>';
                    },
                ]);
                ?>
            </div>
        </div>

        <div class="card-body">
            <div class="mb-6">
                <label class="form-label fw-bold">4. Ad Akses IV atau Terapi Heparin Lock</label>
                <?php
                $options = [
                    'a' => 'Ya',
                    'b' => 'Tidak',
                ];
                echo Html::radioList('FormData[terapi_heparin]', $data['terapi_heparin'] ?? null, $options, [
                    'class' => 'd-flex flex-wrap',
                    'item' => function ($index, $label, $name, $checked, $value) {
                        $score = ($value == 'a') ? 15 : 0;
                        return '<div class="form-check me-4">' .
                            Html::radio($name, $checked, [
                                'value' => $value,
                                'class' => 'form-check-input risk-score',
                                'data-score' => $score,
                                'id' => 'terapi_heparin_' . $index
                            ]) .
                            Html::label($label, 'terapi_heparin_' . $index, [
                                'class' => 'form-check-label'
                            ]) .
                            '</div>';
                    },
                ]);
                ?>
            </div>
        </div>

        <div class="card-body">
            <div class="mb-6">
                <label class="form-label fw-bold">5. Cara Berjalan / Berpindah</label>
                <?php
                $options = [
                    'a' => 'Normal',
                    'b' => 'Lemah, Langkah, Diseret',
                    'c' => 'Terganggu, Perlu Bantuan, Keseimbangan Buruk',
                ];
                echo Html::radioList('FormData[cara_berjalan]', $data['cara_berjalan'] ?? null, $options, [
                    'class' => 'd-flex flex-wrap',
                    'item' => function ($index, $label, $name, $checked, $value) {
                        $scores = [
                            'a' => 0,
                            'b' => 10,
                            'c' => 15,
                        ];
                        $score = $scores[$value] ?? 0;
                        return '<div class="form-check me-4">' .
                            Html::radio($name, $checked, [
                                'value' => $value,
                                'class' => 'form-check-input risk-score',
                                'data-score' => $score,
                                'id' => 'cara_berjalan_' . $index
                            ]) .
                            Html::label($label, 'cara_berjalan_' . $index, [
                                'class' => 'form-check-label'
                            ]) .
                            '</div>';
                    },
                ]);
                ?>
            </div>
        </div>

        <div class="card-body">
            <div class="mb-6">
                <label class="form-label fw-bold">6. Status Mental</label>
                <?php
                $options = [
                    'a' => 'Orientasi Sesuai Kemampuan Diri',
                    'b' => 'Lupa Keterbatasan Diri',
                ];
                echo Html::radioList('FormData[status_mental]', $data['status_mental'] ?? null, $options, [
                    'class' => 'd-flex flex-wrap',
                    'item' => function ($index, $label, $name, $checked, $value) {
                        $score = ($value == 'a') ? 0 : 15;
                        return '<div class="form-check me-4">' .
                            Html::radio($name, $checked, [
                                'value' => $value,
                                'class' => 'form-check-input risk-score',
                                'data-score' => $score,
                                'id' => 'status_mental_' . $index
                            ]) .
                            Html::label($label, 'status_mental_' . $index, [
                                'class' => 'form-check-label'
                            ]) .
                            '</div>';
                    },
                ]);
                ?>
            </div>
        </div>

        <div class="card-body">
            <div class="col-md-6">
                <label class="form-label">Nilai Total Score</label>
                <span id="total-score" class="h4 ms-2">0</span>
                <input type="hidden" name="FormData[total_score]" id="hidden-total-score">
            </div>
            <div class="col-md-6">
                <label class="form-label">Kategori Risiko</label>
                <span id="risk-category" class="h4 ms-2">0</span>
                <input type="hidden" name="FormData[kategori_risiko]" id="hidden-risk-category">
            </div>
            <div class="col-md-6">
                <label class="form-label">Intevensi Risiko</label>
                <span id="risk-intervention" class="h4 ms-2">0</span>
                <input type="hidden" name="FormData[intervensi_risiko]" id="hidden-risk-intervention">
            </div>
        </div>
    </div>

    <div class="form-group mt-4">
        <?= Html::submitButton('Simpan Data', ['class' => 'btn btn-success btn-lg']) ?>
        <?= Html::a('Kembali', ['data-form/index'], ['class' => 'btn btn-secondary btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>