<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\DataRegistrasi $model */

$this->title = 'Update Data Registrasi: ' . $model->nama_pasien;
$this->params['breadcrumbs'][] = ['label' => 'Data Registrasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_registrasi, 'url' => ['view', 'id_registrasi' => $model->id_registrasi]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="data-registrasi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>