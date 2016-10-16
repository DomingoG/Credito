<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Administrativo */

$this->title = 'Update Administrativo: ' . $model->iddepartamento;
$this->params['breadcrumbs'][] = ['label' => 'Administrativos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->iddepartamento, 'url' => ['view', 'id' => $model->iddepartamento]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="administrativo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
