<?php
use backend\models\Carrera;
use backend\models\Ciudad;
use backend\models\Semestre;
use backend\models\Alumno;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\Alumno */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alumno-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Matricula')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidopaterno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidomaterno')->textInput(['maxlength' => true]) ?>

    
       <?php 
    $modelsemestre=Semestre::find()->asArray()->all();
    $mapeocombo=ArrayHelper::map($modelsemestre,"idsemestre","semestre");
    echo $form->field($model, 'semestre')->dropDownList($mapeocombo,['prompt' => 'Seleccione una opcion' ]); 
    ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

     <?php 
    $modelciudad=Ciudad::find()->asArray()->all();
    $mapeocombo=ArrayHelper::map($modelciudad,"idciudad","ciudad");
    echo $form->field($model, 'ciudad')->dropDownList($mapeocombo,['prompt' => 'Seleccione una opcion' ]); 
    ?>
    
    <?php 
    $modelcarrera=Carrera::find()->asArray()->all();
    $mapeocombo=ArrayHelper::map($modelcarrera,"idcarrera","carrera");
    echo $form->field($model, 'carrera')->dropDownList($mapeocombo,['prompt' => 'Seleccione una opcion' ]); 
    ?>

    <?= $form->field($modeluser, 'username')->textInput() ?>

    <?= $form->field($modeluser, 'email') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

