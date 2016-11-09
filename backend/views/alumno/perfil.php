<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Administrativo */

$this->title = 'Datos generales';



$this->params['breadcrumbs'][] = $this->title;
?>


    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->Matricula], ['class' => 'btn btn-primary']) ?>
       
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Matricula',
            'nombre',
            'apellidopaterno',
            'apellidomaterno',
            'telefono',
            'ciudad0.ciudad',
            'carrera0.carrera',
            'semestre0.semestre',
            'usuario0.username',
           [
            'attribute' => 'usuario0.email',
            'label' => 'Email',
            ]
            

        ],
    ]) ?>