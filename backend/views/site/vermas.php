<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

?>
<?php

 
$this->title = 'Ver Mas: ';
$this->params['breadcrumbs'][] = ['label' => 'Creditos', 'url' => ['creditolista']];
//$this->params['breadcrumbs'][] = ['label' => $model->idcredito, 'url' => ['view', 'id' => $model->idcredito]];
$this->params['breadcrumbs'][] = $this->title;

?>

		
		<h1><?= Html::encode($model->actividad) ?></h1>
     <p class="list-group-item active"><b>Total de creditos a obtener</b></a>
		</p>
  		<li class="list-group-item"><?= Html::encode($model->credito) ?></li>
		<br/><br />
		<p class="list-group-item active"><b>Periodos para realizarlo</b></a>
  		<?php 

     foreach ($model->list as $operacionPermitida) {?>
        <ul class="list-group">
            <li class="list-group-item"><?php echo $operacionPermitida['semestre']?></li>
    <?php
            
        }
    ?>
		<br/><br />
		<p class="list-group-item active"><b>Informacion</b></a>
      <li class="list-group-item"><?= Html::encode($model->comentario) ?></li>
  		
    </p>
		<br/><br />
		<p class="list-group-item active"><b>Encargado</b></a>
      <li class="list-group-item"><?= Html::encode($modeldepa->encargado) ?></li>
  		<li class="list-group-item"><?= Html::encode($modeldepa->departamento) ?></li>

      </p>
		<br /><br />
		<p class="list-group-item active"><b>Estado</b></a>
  		<li class="list-group-item"><?= Html::encode($model->obligatorio)." Es obligatorio" ?></li>
      </p>
		<br /><br />
		

        <?php if ($contar == 0): ?>

        <?= Html::a('Registrate', ['registro', 'id' => $model->idcredito], [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => '¿Está seguro inscribirse a esta Actividad?',
                'method' => 'post',
            ],
        ]) ?>
        <?php endif ?>

        <?php if ($limit == 1): ?>
          <div class="description help-block" > No hay Cupo solo se permite <?=$model->limite?> alumnos </div>
        
       	<?php endif ?>

    <?php if ($sino == 1): ?>
    
    <div class="description help-block" > En hora buena  </div>
    <h1>!!FELICIDADES CREDITO OBTENIDO</h1>
     
     
    
    
    <?php endif; ?>


    