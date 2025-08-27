<?php
use yii\helpers\Url;
use yii\helpers\Html;
/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Selamat Datang!</h1>

        <p class="lead">Klinik OBGYN</p>

        <p><a class="btn btn-lg btn-success" href="#"></a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6 mb-3">
                <h2>Halaman Data Registrasi</h2>

                <p>Halaman untuk menampilkan data registrasi pasien yang baru masuk</p>

                <p><a class="btn btn-outline-secondary" href="<?= Url::to(['/data-registrasi/index']) ?>">Data Registrasi &raquo;</a></p>
            </div>
            <div class="col-lg-6 mb-3">
                <h2>Halaman Data Formulir</h2>

                <p>Halaman untuk handling data formulir berdasarkan data registrasi pasien yang baru masuk</p>

                <p><a class="btn btn-outline-secondary" href="<?= Url::to(['/data-form/index']) ?>">Data Formulir &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
