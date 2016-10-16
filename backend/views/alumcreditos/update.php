<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Alumcreditos */

$this->title = 'Update Alumcreditos: ' . $model->idreporte;
$this->params['breadcrumbs'][] = ['label' => 'Alumcreditos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idreporte, 'url' => ['view', 'id' => $model->idreporte]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="alumcreditos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
