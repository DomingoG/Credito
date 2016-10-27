<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Role;
use backend\models\Status;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'email') ?>
        
    <?php 
    $modelStatus=Status::find()->asArray()->all();
    $mapeocombo=ArrayHelper::map($modelStatus,"status_value","status_name");
    echo $form->field($model,'status_id')->dropDownList($mapeocombo,['prompt' =>'Seleccione una opcion' ]); 
    ?>

    
    <?php 
    $modelRol=Role::find()->asArray()->all();
    $mapeocombo=ArrayHelper::map($modelRol,"role_value","role_name");
    echo $form->field($model, 'role_id')->dropDownList($mapeocombo,['prompt' => 'Seleccione una opcion']);  
    ?>

    <!--?= $form->field($model, 'user_type_id') ?-->

    <div class="form-group">
        <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>      
    </div>

    <?php ActiveForm::end(); ?>

</div>
