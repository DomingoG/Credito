<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CreditosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="creditos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idcredito') ?>

    <?= $form->field($model, 'actividad') ?>

    <?= $form->field($model, 'credito') ?>

    <?= $form->field($model, 'periodo') ?>

    <?= $form->field($model, 'comentario') ?>

    <?php // echo $form->field($model, 'responsable') ?>

    <?php // echo $form->field($model, 'obligatorio') ?>

    <?php // echo $form->field($model, 'limite') ?>

    <?php // echo $form->field($model, 'imagen') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
