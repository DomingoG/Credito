<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AvisosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="avisos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idavisos') ?>

    <?= $form->field($model, 'informacion') ?>

    <?= $form->field($model, 'departamento') ?>

    <?= $form->field($model, 'fechaevento') ?>

    <?= $form->field($model, 'credito') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
