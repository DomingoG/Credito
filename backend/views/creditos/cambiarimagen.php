<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;



/* @var $this yii\web\View */
/* @var $model backend\models\Creditos */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="creditos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $r = str_replace("/web", "", Yii::$app->request->baseUrl) ?>;
     <?= Html::img( $r.'/imagens/'.' '. $model->imagen, ['class' => 'img-thumbnail', 'width' => 250]) ?>
    <br> 
        
    <div class="btn btn-info ">
     <?= $form->field($model,'imagen')->fileInput() ?> 

    </div>
        
     <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
