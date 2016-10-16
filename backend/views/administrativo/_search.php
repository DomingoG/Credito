<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdministrativoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="administrativo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'iddepartamento') ?>

    <?= $form->field($model, 'departamento') ?>

    <?= $form->field($model, 'encargado') ?>

    <?= $form->field($model, 'telefono') ?>

    <?= $form->field($model, 'usuario') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
