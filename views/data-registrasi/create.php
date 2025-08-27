<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\DataRegistrasi $model */

$this->title = 'Create Data Registrasi';
$this->params['breadcrumbs'][] = ['label' => 'Data Registrasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-registrasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
