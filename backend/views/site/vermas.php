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
		<p><label>Total de creditos a optener</label>:</p>
  		<?= Html::encode($model->credito) ?>
		<br/><br />
		<p><label>Periodo a realizar</label>:</p>
  		<?= Html::encode($model->periodo)." semestre" ?>
		<br/><br />
		<p><label>Informacion</label>:</p>
  		<?= Html::encode($model->comentario) ?>
		<br/><br />
		<p><label>Responsable de asignacion</label>:</p>
  		<?= Html::encode($model->responsable) ?>
		<br /><br />
		<p><label>Estado</label>:</p>
  		<?= Html::encode($model->obligatorio)." Es obligatorio" ?>
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