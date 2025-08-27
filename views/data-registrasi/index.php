<?php

use app\models\DataRegistrasi;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Data Registrasi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-registrasi-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Data Registrasi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'no_registrasi',
            'no_rekam_medis',
            'nama_pasien',
            'tanggal_lahir',
            'nik',
            [
                'attribute' => 'is_delete',
                'label' => 'Status',
                'value' => function ($model) {
                    return $model->is_delete ? 'Dihapus' : 'Aktif';
                },
                'contentOptions' => function ($model) {
                    return $model->is_delete ? ['class' => 'text-danger'] : [];
                },
            ],
            [
                'attribute' => 'update_time_at',
                'label' => 'Tgl. Diperbarui',
                'format' => ['date', 'php:Y-m-d'],
                'contentOptions' => ['style' => 'white-space: nowrap;'],
            ],
            [
                'attribute' => 'update_time_at',
                'label' => 'Jam Diperbarui',
                'format' => ['time', 'php:H:i:s'],
                'contentOptions' => ['style' => 'white-space: nowrap;'],
            ],
            [
                'class' => ActionColumn::class,
                'header' => 'Aksi',
                'template' => '{input_form} {update} {delete} {view}',
                'buttons' => [
                    'input_form' => function ($url, $model, $key) {
                        return $model->is_delete ? '' : Html::a(
                            '<span class="fa-solid fa-file-lines"></span> Input Form',
                            Url::to(['data-form/input', 'id_registrasi' => $model->id_registrasi]),
                            [
                                'title' => 'Input Form Keperawatan',
                                'class' => 'btn btn-sm btn-info me-1'
                            ]
                        );
                    },
                    'delete' => function ($url, $model, $key) {
                        return $model->is_delete ? '' : Html::a(
                            '<span class="glyphicon glyphicon-trash"></span> Delete',
                            Url::to(['delete', 'id_registrasi' => $model->id_registrasi]),
                            [
                                'title' => 'Hapus Data Registrasi',
                                'class' => 'btn btn-sm btn-danger',
                                'data' => [
                                    'confirm' => 'Apakah Anda yakin ingin menghapus data ini?',
                                    'method' => 'post',
                                ],
                            ]
                        );
                    },
                    'update' => function ($url, $model, $key) {
                        $updateUrl = Url::to(['update', 'id_registrasi' => $model->id_registrasi]);

                        return $model->is_delete ? '' : Html::a(
                            '<span class="glyphicon glyphicon-pencil"></span> Edit',
                            $updateUrl,
                            [
                                'title' => 'Edit Data Registrasi',
                                'class' => 'btn btn-sm btn-primary me-1'
                            ]
                        );
                    },
                    'delete' => function ($url, $model, $key) {
                        return $model->is_delete ? '' : Html::a(
                            '<span class="glyphicon glyphicon-trash"></span> Delete',
                            Url::to(['delete', 'id_registrasi' => $model->id_registrasi]),
                            [
                                'title' => 'Hapus Data Registrasi',
                                'class' => 'btn btn-sm btn-danger',
                                'data' => [
                                    'confirm' => 'Apakah Anda yakin ingin menghapus data ini?',
                                    'method' => 'post',
                                ],
                            ]
                        );
                    },
                    
                    'view' => function ($url, $model, $key){
                        return Html::a(
                            '<span class="glyphicon glyphicon-info"></span> View',
                            Url::to(['data-registrasi/view', 'id_registrasi' => $model->id_registrasi]),
                            [
                                'title' => 'Input Form Keperawatan',
                                'class' => 'btn btn-sm btn-info me-1'
                            ]
                        );
                    }
                ],
                'contentOptions' => ['style' => 'width: 300px; white-space: nowrap;'],
            ],
        ],
    ]); 
    ?>
    <p>
        <?= Html::a('Lihat Semua Data Formulir', ['data-form/index'], ['class' => 'btn btn-secondary']) ?>
    </p>

</div>