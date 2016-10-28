<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Administrativo;
use backend\models\Semestre;

/* @var $this yii\web\View */
/* @var $model backend\models\Creditos */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="creditos-form">

    <?php $form = ActiveForm::begin(); ?>


    <?php if ($model->isNewRecord == True): ?>  
    <?= $form->field($model,'imagen')->fileInput() ?>       
    <div class="description help-block" > Las imágenes deben medir exactamente 250x250 píxeles</div>
    <?php endif ?>

    <?php if ($model->isNewRecord == False): ?>
    

        <div id="content" style="display: none;">
        <?= $form->field($model,'imagen')->fileInput() ?>       
        </div>
     <?php $r = str_replace("/web", "", Yii::$app->request->baseUrl) ?>;
     <?= Html::img( $r.'/imagens/'.' '. $model->imagen, ['class' => 'img-thumbnail', 'width' => 250]) ?>
     <br>
     <div style="color:#999;margin:1em 0">
        <input type="checkbox" name="check" id="check" value="1" onchange="javascript:showContent()" />
         Cambiar Imagen
     </div>
                   
    <script type="text/javascript">
    function showContent() {
        element = document.getElementById("content");
        check = document.getElementById("check");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
    </script>
    
    
    <?php endif; ?>

    <?= $form->field($model, 'idcredito')->textInput() ?>

    <?= $form->field($model, 'actividad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'credito')->textInput(['type' => 'number','min'=>1,'max'=>10]) ?>

     <?php 
    $modelSemestre=Semestre::find()->asArray()->all();
    $mapeocombo=ArrayHelper::map($modelSemestre,"idsemestre","semestre");
    echo $form->field($model, 'operaciones')->checkboxList($mapeocombo, ['unselect'=>NULL]);
    ?>

    <?= $form->field($model, 'comentario')->textarea(['rows' => 6]) ?>

    <!--?= $form->field($model, 'responsable')->textInput() ?-->
    <?php 
    $modeldepa=Administrativo::find()->asArray()->all();
    $mapeocombo=ArrayHelper::map($modeldepa,"iddepartamento","departamento");
    echo $form->field($model, 'responsable')->dropDownList($mapeocombo,['prompt' => '' ]); 
    ?>

    <?= $form->field($model, 'obligatorio')->dropDownList([ 'SI' => 'SI', 'NO' => 'NO', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'limite')->textInput() ?>

     <!--?= $form->field($model, 'imagen')->textInput(['maxlength' => true]) ?-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
