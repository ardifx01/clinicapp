<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\DataForm $model */

$this->title = 'Update Data Form: ' . $model->id_form_data;
$this->params['breadcrumbs'][] = ['label' => 'Data Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_form_data, 'url' => ['view', 'id_form_data' => $model->id_form_data]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="data-form-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
