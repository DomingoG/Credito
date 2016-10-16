<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Administrativo;

/* @var $this yii\web\View */
/* @var $model backend\models\Creditos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="creditos-form">

    <?php $form = ActiveForm::begin(); ?>


     <?php if ($model->isNewRecord == True): ?>
    <?= $form->field($model,'imagen')->fileInput() ?>
     <div class="description help-block" > Las imágenes deben medir exactamente 250x250 píxeles. </div>
    <?php endif ?>

    <?php if ($model->isNewRecord == False): ?>
    <?php if ($model->imagen): ?>
    <div class="row imagen">
     <?php $r = str_replace("/web", "", Yii::$app->request->baseUrl) ?>;
     <?= Html::img( $r.'/imagens/'. $model->imagen, ['class' => 'img-thumbnail', 'width' => 250]) ?>
    </div>
    <?php endif; ?>
    <?php endif; ?>

    <?= $form->field($model, 'idcredito')->textInput() ?>

    <?= $form->field($model, 'actividad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'credito')->textInput(['type' => 'number','min'=>1,'max'=>10]) ?>

    <?= $form->field($model, 'periodo')->textInput(['maxlength' => true]) ?>
    
    <!--?= Html::Checkboxlist('Periodo','periodo',[
        'Primer Semestre'=>'Primer Semestre',
        'Segundo Semestre'=>'Segundo Semestre',
        'Tercer Semestre'=>'Tercer Semestre',
        'Cuarto Semestre'=>'Cuarto Semestre',
        'Quinto Semestre'=>'Quinto Semestre',
        'Sexto Semestre'=>'Sexto Semestre',
        'Septimo Semestre'=>'Septimo Semestre',
        'Octavo Semestre'=>'Octavo Semestre',
        'Noveno Semestre'=>'Noveno Semestre',


    ])?-->
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
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
