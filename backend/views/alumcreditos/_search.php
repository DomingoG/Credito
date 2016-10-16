<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AlumcreditosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alumcreditos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idreporte') ?>

    <?= $form->field($model, 'credito') ?>

    <?= $form->field($model, 'departamento') ?>

    <?= $form->field($model, 'alumno') ?>

    <?= $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'aprobado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
