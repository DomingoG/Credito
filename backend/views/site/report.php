<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\grid\DataColumn;
?>
<?php
$this->title = 'Aprobados';
$this->params['breadcrumbs'][] = $this->title;
?>

<h3>Reporte de Creditos del alumno:<?php echo $alumno->nombre.' '.$alumno->apellidopaterno; ?></h3>
<p>
	<?= Html::a('Exportar a PDF', ['reportealumno'],['target'=>'_blank','class' => 'btn btn-warning']) ?>
</p>
<p>Creditos Aprobados</p>
<div class="administrativo-index">
<?= GridView::widget([
        'dataProvider' => $modelsi,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
            'attribute' => 'alumno',
            'label' => 'Matricula',
            'format' => 'raw',
            
            ],
            [
            'attribute' => 'alumno.nombre',
            'label' => 'Nombre',
            'format' => 'raw',
            'content'=>function($data){##data accesso a toda fila
               return $data->getNombre();
            },
            ],
            [
            'attribute' => 'alumno.apellidopaterno',
            'label' => 'Apellido',
            'format' => 'raw',
            'content'=>function($data){##data accesso a toda fila
               return $data->getApellido();
            },
            ],
            [
            'attribute' => 'administrativo.departamento',
            'label' => 'Departamento',
            'format' => 'raw',
            'content'=>function($data){##data accesso a toda fila
               return $data->getDepartamento();
            },
            ],
            [
            'attribute' => 'administrativo.encargado',
            'label' => 'Responsable',
            'format' => 'raw',
            'content'=>function($data){##data accesso a toda fila
               return $data->getEncargado();
            },
            ],
            
            
            'fechaaprobacion',

             'aprobado',
             

          //  ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<p>Creditos Inscritos</p>
<div class="administrativo-index">
<?= GridView::widget([
        'dataProvider' => $modelno,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
            'attribute' => 'alumno',
            'label' => 'Matricula',
            'format' => 'raw',
            
            ],
            [
            'attribute' => 'alumno.nombre',
            'label' => 'Nombre',
            'format' => 'raw',
            'content'=>function($data){##data accesso a toda fila
               return $data->getNombre();
            },
            ],
            [
            'attribute' => 'alumno.apellidopaterno',
            'label' => 'Apellido',
            'format' => 'raw',
            'content'=>function($data){##data accesso a toda fila
               return $data->getApellido();
            },
            ],
            [
            'attribute' => 'administrativo.departamento',
            'label' => 'Departamento',
            'format' => 'raw',
            'content'=>function($data){##data accesso a toda fila
               return $data->getDepartamento();
            },
            ],
            [
            'attribute' => 'administrativo.encargado',
            'label' => 'Responsable',
            'format' => 'raw',
            'content'=>function($data){##data accesso a toda fila
               return $data->getEncargado();
            },
            ],
            
            
            'fechaaprobacion',

             'aprobado',
             

          //  ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>