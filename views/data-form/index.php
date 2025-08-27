<?php

use app\models\DataForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Data Forms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-form-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Lihat Semua Data Registrasi', ['data-registrasi/index'], ['class' => 'btn btn-secondary']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn'
            ],
            // 'id_form',
            // 'is_delete',
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
                'attribute' => 'registrasi.nama_pasien',
                'label' => 'Nama Pasien',
            ],
            [
                'attribute' => 'registrasi.no_rekam_medis',
                'label' => 'No. Rekam Medis',
            ],
            [
                'attribute' => 'registrasi.no_registrasi',
                'label' => 'No. Registrasi',
            ],
            [
                'class' => ActionColumn::class,
                'header' => 'Aksi',
                'template' => '{edit} {detail} {delete} {print}',
                'buttons' => [
                    'edit' => function ($url, $model, $key) {
                        if($model->is_delete){
                            return Html::a(
                                '<span class="glyphicon glyphicon-trash"></span> Edit Form',
                                '#',
                                [
                                    'class' => 'btn btn-sm btn-secondary disabled',
                                    'title' => 'Data ini sudah dihapus.'
                                ]
                            );
                        } else {
                            return Html::a(
                                '<span class="glyphicon glyphicon-file"></span> Edit Form',
                                Url::to(['data-form/input', 'id_registrasi' => $model->id_registrasi]),
                                [
                                    'title' => 'Edit Data Form',
                                    'class' => 'btn btn-sm btn-info me-1',
                                    'data' => [
                                        'title' => 'Input Form Keperawatan',
                                        'class' => 'btn btn-sm btn-info me-1'
                                    ],
                                ]
                            );
                        }
                    },
                    'detail' => function ($url, $model, $key) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-file"></span> Detail',
                            Url::to(['data-form/detail', 'id_form_data' => $model->id_form_data]),
                            [
                                'title' => 'Lihat Detail Data Form',
                                'class' => 'btn btn-sm btn-success me-1'
                            ]
                        );
                    },
                    'delete' => function ($url, $model, $key) {
                        if ($model->is_delete) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-trash"></span> Dihapus',
                                '#',
                                [
                                    'class' => 'btn btn-sm btn-secondary disabled',
                                    'title' => 'Data ini sudah dihapus.'
                                ]
                            );
                        } else {
                            return Html::a(
                                '<span class="glyphicon glyphicon-trash"></span> Hapus',
                                Url::to(['delete', 'id_form_data' => $model->id_form_data]),
                                [
                                    'title' => 'Hapus Data Form',
                                    'class' => 'btn btn-sm btn-danger',
                                    'data' => [
                                        'confirm' => 'Apakah Anda yakin ingin menghapus data Formulir ini?',
                                        'method' => 'post',
                                    ],
                                ]
                            );
                        }
                    },
                    'print' => function ($url, $model, $key) {
                        return Html::a(
                            '<span class="fa-solid fa-print"></span> Cetak',
                            Url::to(['data-form/print', 'id_form_data' => $model->id_form_data]),
                            [
                                'title' => 'Cetak Formulir',
                                'class' => 'btn btn-sm btn-warning me-1',
                                'target' => '_blank'
                            ]
                        );
                    }
                ]
            ]
        ]

    ]);
    ?>


</div>