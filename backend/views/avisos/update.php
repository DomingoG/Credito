<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Avisos */

$this->title = 'Modificar Avisos: ' . $model->idavisos;
$this->params['breadcrumbs'][] = ['label' => 'Avisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idavisos, 'url' => ['view', 'id' => $model->idavisos]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="avisos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,'modelcarrera'=>$modelcarrera
    ]) ?>

</div>
