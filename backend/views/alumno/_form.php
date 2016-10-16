<?php
use backend\models\Carrera;
use backend\models\Ciudad;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\Alumno */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alumno-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Matricula')->textInput() ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidopaterno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidomaterno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'semestre')->dropDownList([ 
    '1' => 'Semestre 1',
    '2' => 'Semestre 2',
    '3' => 'Semestre 3',
    '4' => 'Semestre 4',
    '5' => 'Semestre 5',
    '6' => 'Semestre 6',
    '7' => 'Semestre 7',
    '8' => 'Semestre 8',
    '9' => 'Semestre 9',
     
     ], ['prompt' => '']) ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

     <?php 
    $modelciudad=Ciudad::find()->asArray()->all();
    $mapeocombo=ArrayHelper::map($modelciudad,"idciudad","ciudad");
    echo $form->field($model, 'ciudad')->dropDownList($mapeocombo,['prompt' => '' ]); 
    ?>
    
    <?php 
    $modelcarrera=Carrera::find()->asArray()->all();
    $mapeocombo=ArrayHelper::map($modelcarrera,"idcarrera","carrera");
    echo $form->field($model, 'carrera')->dropDownList($mapeocombo,['prompt' => '' ]); 
    ?>

    <!--?= $form->field($model, 'usuario')->textInput() ?-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

