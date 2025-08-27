<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker; // Untuk input Tanggal Lahir yang lebih user-friendly

/** @var yii\web\View $this */
/** @var app\models\DataRegistrasi $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="data-registrasi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if (!$model->isNewRecord): ?>
        <div class="form-group">
            <label>No Registrasi</label>
            <input type="text" class="form-control" value="<?= $model->no_registrasi ?>" readonly>
        </div>
        <div class="form-group">
            <label>No Rekam Medis</label>
            <input type="text" class="form-control" value="<?= $model->no_rekam_medis ?>" readonly>
        </div>
    <?php endif; ?>
    <?= $form->field($model, 'nama_pasien')->textInput(['maxlength' => 255]) ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'tanggal_lahir')->input('date') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'nik')->textInput(['maxlength' => 16, 'type' => 'number']) ?>
        </div>
    </div>

    <div class="form-group mt-3">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Batal', ['index'], ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
