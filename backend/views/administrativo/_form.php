<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Administrativo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="administrativo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'departamento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'encargado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <!--?= $form->field($model, 'usuario')->textInput() ?-->
    <?php 
    $modelUser=User::find()->asArray()->where(['role_id'=>20])->all();
    $mapeocombo=ArrayHelper::map($modelUser,"id","username");
    echo $form->field($model, 'usuario')->dropDownList($mapeocombo,['prompt' => '' ]); 
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
