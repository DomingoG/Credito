<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Administrativo */

$this->title = $model->iddepartamento;
$this->params['breadcrumbs'][] = ['label' => 'Administrativos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="administrativo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->iddepartamento], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->iddepartamento], [
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
            'iddepartamento',
            'departamento',
            'encargado',
            'telefono',
            'usuario0.username',
        ],
    ]) ?>

</div>
