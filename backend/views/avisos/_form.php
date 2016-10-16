<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use backend\models\Creditos;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Avisos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="avisos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'informacion')->textarea(['rows' => 6]) ?>

    <!--?= $form->field($model, 'departamento')->textInput() ?-->

    <!--?= $form->field($model, 'fecha')->textInput() ?-->

    <?php echo $form->field($model, 'fechaevento')->widget(DatePicker::className(),[
        
        'dateFormat' => 'yyyy-MM-dd',
         'name' => 'dp_3',
         'language' => 'es',
         'clientOptions' => [
           'yearRange' => '-115:+0',
           'autoclose'=>true,
           'changeYear' => true
          ],
          'options' => ['class' => 'form-control', 'style' => 'width:25%']
    
    ]) ?>

    

    <?php 
    $mapeocombo=ArrayHelper::map($modelcarrera,"idcredito","actividad");
    echo $form->field($model, 'credito')->dropDownList($mapeocombo,['prompt' => '' ]); 
    ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
