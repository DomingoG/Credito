<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Alumcreditos */

$this->title = $model->idreporte;
$this->params['breadcrumbs'][] = ['label' => 'Alumcreditos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alumcreditos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idreporte], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idreporte], [
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
            'idreporte',
            'credito',
            'departamento',
            'alumno',
            'fecha',
            'aprobado',
        ],
    ]) ?>

</div>
