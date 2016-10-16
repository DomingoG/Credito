<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Creditos */

$this->title = 'Update Creditos: ' . $model->idcredito;
$this->params['breadcrumbs'][] = ['label' => 'Creditos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idcredito, 'url' => ['view', 'id' => $model->idcredito]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="creditos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
