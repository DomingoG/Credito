<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Alumcreditos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alumcreditos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'credito')->textInput() ?>

    <?= $form->field($model, 'departamento')->textInput() ?>

    <?= $form->field($model, 'alumno')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'aprobado')->dropDownList([ 'No' => 'No', 'Si' => 'Si', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
