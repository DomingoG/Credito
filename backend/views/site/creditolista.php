<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\grid\DataColumn;
?>

<?php
$this->title = 'Lista Creditos';
$this->params['breadcrumbs'][] = $this->title;
?>
 
<h1>INFORMACION RELATIVA A ACTIVIDADES COMPLEMENTARIAS</h1>

<H3>Las actividades complementarias es una asignatura dentro de la reticula, tiene un valor de cinco creditos.</H3>
<p>Manera para obtener los cinco creditos es la siguiente:</p>
<br>
<h2>ACTIVIDADES OBLIGATORIAS</h2>
   <div >
    <table class="table  table-hover table-condensed">
      <tr>
            <th></th>
            <th>Actividad</th>
            <th></th>
            
      </tr>
     <?php foreach($listasi as $row): ?>
       <tr> 
            <td> <?php $r = str_replace("/web", "", Yii::$app->request->baseUrl) ?>
     <?= Html::img( $r.'/imagens/'.' '. $row->imagen, ['class' => 'img-thumbnail', 'width' => 250]) ?>
            </td>
            <td><?= $row->actividad ?><br>
            <?= $row->comentario ?></td>
            <td><a  class='btn btn-info' data-toggle="tooltip" title="Mas Infor.." href="<?= Url::toRoute(['site/vermas','idcredito' => $row->idcredito])?>">Leer Mas &raquo;</a></td>

       </tr> 
       <?php endforeach ?>
    </table>

    <h2>ACTIVIDADES OBLIGATORIAS</h2>
	<p>Para obtener el credito restante tienes las siguientes opciones:</p>
	<br>
     <table class="table table-hover">
      <tr>
            <th></th>
            <th>Actividad</th>
            <th></th>
      </tr>
     <?php foreach($listano as $row): ?>
       <tr>
            <td> <?php $r = str_replace("/web", "", Yii::$app->request->baseUrl) ?>
     		<?= Html::img( $r.'/imagens/'.' '. $row->imagen, ['class' => 'img-thumbnail', 'width' => 250 ]) ?>  </td>
            <td><?= $row->actividad ?><br>
            <?= $row->comentario ?></td>
            <td><a class='btn btn-info'  href="<?= Url::toRoute(['site/vermas','idcredito' => $row->idcredito])?>">Leer Mas &raquo;</a></td>

       </tr>
       <?php endforeach ?>
    </table>
    </div>