<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Administrativo */

$this->title = $model->departamento;
$this->params['breadcrumbs'][] = ['label' => 'Administrativos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="administrativo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->iddepartamento], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->iddepartamento], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Seguro que quieres eliminar este departamento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'iddepartamento',
            'departamento',
            'encargado',
            'telefono',
            'usuario0.username',
        ],
    ]) ?>

</div>
