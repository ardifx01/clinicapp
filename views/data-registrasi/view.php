<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\DataRegistrasi $model */

$this->title = $model->id_registrasi;
$this->params['breadcrumbs'][] = ['label' => 'Data Registrasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="data-registrasi-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_registrasi',
            'no_registrasi',
            'no_rekam_medis',
            'nama_pasien',
            'tanggal_lahir',
            'nik',
            'is_delete',
            'create_by',
            'create_time_at',
            'update_by',
            'update_time_at',
        ],
    ]) ?>

</div>
