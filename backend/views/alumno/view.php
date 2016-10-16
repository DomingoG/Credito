<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Alumno */

$this->title = $model->Matricula;
$this->params['breadcrumbs'][] = ['label' => 'Alumnos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alumno-view">

    <h1><?= Html::encode($this->title) ?></h1>
 
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->Matricula], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->Matricula], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Matricula',
            'nombre',
            'apellidopaterno',
            'apellidomaterno',
            'semestre',
            'telefono',
            'ciudad',
            'carrera',
            'usuario',
        ],
    ]) ?>

</div>
