<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Alumno */

$this->title = 'Actualizar datos Alumno: ' . $model->Matricula;
//$this->params['breadcrumbs'][] = ['label' => 'Alumnos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Matricula, 'url' => ['view', 'id' => $model->Matricula]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="alumno-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modeluser'=>$modeluser,
    ]) ?>

</div>
