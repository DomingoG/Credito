<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Alumno */

$this->title = $model->Matricula;
//$this->params['breadcrumbs'][] = ['label' => 'Alumnos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?> 
<div class="alumno-view">
<?= Html::button('Volver', [
            'name' => 'btnBack',
            'class'=>'btn btn-info',
            'style' => 'width:150px;',
            'onclick' => "history.go(-1)",
                ]
                );
     ?><br><br>
    <h1><?= Html::encode($this->title) ?></h1>
   
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Matricula',
            'nombre',
            'apellidopaterno',
            'apellidomaterno',
            'semestre',
            'telefono',
            'ciudad0.ciudad',
            'carrera0.carrera',
            
           // 'usuario',
        ],
    ]) ?>

</div>
