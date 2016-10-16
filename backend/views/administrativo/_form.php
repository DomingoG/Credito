<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Administrativo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="administrativo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'departamento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'encargado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usuario')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
