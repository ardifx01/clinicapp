
// FUNCTION KALKULASI RISIKO JATUH
function calculateTotalScore() {
    let totalScore = 0;
    const scores = document.querySelectorAll('.risk-score:checked');
    scores.forEach(input => {
        totalScore += parseInt(input.getAttribute('data-score'));
    });

    const totalScoreElement = document.getElementById('total-score');
    totalScoreElement.textContent = totalScore;
    document.getElementById('hidden-total-score').value = totalScore;

    let category = '';
    let intervention = '';

    if (totalScore >= 0 && totalScore <= 24) {
        category = 'Risiko Rendah';
        intervention = 'Perawatan Yang Baik';
    } else if (totalScore >= 25 && totalScore <= 44) {
        category = 'Risiko Sedang';
        intervention = 'Lakukan Intervensi Jatuh Standar';
    } else if (totalScore >= 45) {
        category = 'Risiko Tinggi';
        intervention = 'Lakukan Intervensi Jatuh Risiko Tinggi';
    }

    const categoryElement = document.getElementById('risk-category');
    const interventionElement = document.getElementById('risk-intervention');

    categoryElement.textContent = category;
    interventionElement.textContent = intervention;

    document.getElementById('hidden-risk-category').value = category;
    document.getElementById('hidden-risk-intervention').value = intervention;
}

document.querySelectorAll('.risk-score').forEach(input => {
    input.addEventListener('change', calculateTotalScore);
});
document.addEventListener('DOMContentLoaded', calculateTotalScore);

// FUNCTION KALKULASI IMT
function calculateImt() {
    var beratBadan = parseFloat($('#berat_badan').val());
    var tinggiBadanCm = parseFloat($('#tinggi_badan').val());

    if (isNaN(beratBadan) || isNaN(tinggiBadanCm) || tinggiBadanCm === 0) {
        $('#imt_result').text('0');
        $('#imt_status').text('--');
        $('#imt_value_hidden').val('');
        $('#imt_status_hidden').val('');
        return;
    }

    var tinggiBadanM = tinggiBadanCm / 100;
    var imt = beratBadan / (tinggiBadanM * tinggiBadanM);
    var status = '';

    if (imt <= 18.5) {
        status = 'Kurus';
    } else if (imt > 18.5 && imt <= 25.0) {
        status = 'Normal';
    } else if (imt > 25.0 && imt <= 27.0) {
        status = 'Gemuk';
    } else {
        status = 'Obesitas';
    }

    $('#imt_result').text(imt.toFixed(2));
    $('#imt_status').text(status);
    $('#imt_value_hidden').val(imt.toFixed(2));
    $('#imt_status_hidden').val(status);
}

// Event listeners untuk IMT
$('#berat_badan, #tinggi_badan').on('input', function() {
    calculateImt();
});

// Jalankan kalkulasi saat halaman dimuat
calculateImt();

// JavaScript untuk menampilkan/menyembunyikan form kondisional
// JIKA PILIHAN 'a' RIWAYAT PENYAKIT AKAN MUNCUL
$('input[name="FormData[riwayat_penyakit]"]').on('change', function() {
    if ($(this).val() === 'a') {
        $('#riwayat-penyakit-tambahan').show();
    } else {
        $('#riwayat-penyakit-tambahan').hide();
        $('#riwayat-penyakit-tambahan input').val('');
    }
});

// JIKA PILIHAN 'a' RIWAYAT OPERASI AKAN MUNCUL
$('input[name="FormData[riwayat_operasi]"]').on('change', function() {
    if ($(this).val() === 'a') {
        $('#riwayat-operasi-tambahan').show();
    } else {
        $('#riwayat-operasi-tambahan').hide();
        $('#riwayat-operasi-tambahan input').val('');
    }
});

// JIKA PILIHAN 'a' RIWAYAT RAWAT DI RS
$('input[name="FormData[riwayat_rawat]"]').on('change', function() {
    if ($(this).val() === 'a') {
        $('#riwayat-rawat-tambahan').show();
    } else {
        $('#riwayat-rawat-tambahan').hide();
        $('#riwayat-rawat-tambahan input').val('');
    }
});

// MEMUAT HALAMAN UNTUK EDIT
$(document).ready(function() {
    if ($('input[name="FormData[riwayat_penyakit]"]:checked').val() === 'a') {
        $('#riwayat-penyakit-tambahan').show();
    }
    if ($('input[name="FormData[riwayat_operasi]"]:checked').val() === 'a') {
        $('#riwayat-operasi-tambahan').show();
    }
    if ($('input[name="FormData[riwayat_rawat]"]:checked').val() === 'a') {
        $('#riwayat-rawat-tambahan').show();
    }
});

// JavaScript untuk menampilkan/menyembunyikan detail Aloanamnesis
// $js = <<<JS
//     $('#aloanamnesis_check').on('change', function() {
//         if ($(this).is(':checked')) {
//             $('#aloanamnesis_detail').show();
//         } else {
//             $('#aloanamnesis_detail').hide();
//         }
//     });

//     // Jalankan saat load untuk kasus EDIT
//     if ($('#aloanamnesis_check').is(':checked')) {
//         $('#aloanamnesis_detail').show();
//     }
// JS;
// $this->registerJs($js);
