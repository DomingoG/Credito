<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\grid\GridView;
?>
<?php
$this->title = 'Aprobados';
//$this->params['breadcrumbs'][] = ['label' => '', 'url' => ['creditolista']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1>Lista de alumnos Aprobados Creditos I. Administración</h1>


<div class="administrativo-index">
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'alumno',
            //'idreporte',
            //'credito',
            [
            'attribute'=>'creditos.actividad',
            'label'=>'Credito',
            'format'=>'raw',
            'content'=>function($data){##data accesso a toda fila
               return $data->getActividad();
            },
            ],
            //'departamento',
            

            //'variable con link a modelo',
           /* [
            'attribute' => 'alumno.nombre',
            'label' => 'Nombre',
            'format' => 'raw',
            'value' => function ($model, $key, $index, $grid) {
                return Html::a($model['nombre'], '../web/alumno/view?id='.$model['alumno']);
            },
            ],*/

             [
            'attribute'=>'alumno.nombre',
            'label'=>'Nombre',
            'format'=>'raw',
            'content'=>function($data){##data accesso a toda fila
               return $data->getNombre();
            },
            ],
            [
            'attribute'=>'alumno.apellidopaterno',
            'label'=>'Apellido Paterno',
            'format'=>'raw',
            'content'=>function($data){##data accesso a toda fila
               return $data->getApellido();
            },
            ],
            'fechaaprobacion',

             'aprobado',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>