<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\DataForm $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="data-form-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_form_data')->textInput() ?>

    <?= $form->field($model, 'id_form')->textInput() ?>

    <?= $form->field($model, 'id_registrasi')->textInput() ?>

    <?= $form->field($model, 'data')->textInput() ?>

    <?= $form->field($model, 'is_delete')->checkbox() ?>

    <?= $form->field($model, 'create_by')->textInput() ?>

    <?= $form->field($model, 'update_by')->textInput() ?>

    <?= $form->field($model, 'create_time_at')->textInput() ?>

    <?= $form->field($model, 'update_time_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
