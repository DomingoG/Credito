<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
<body class="fondo">
    <div class="login-page">
        <div class="form">
                <h1><?= Html::encode($this->title) ?></h1>

                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                        <?= $form->field($model, 'password')->passwordInput() ?>

                        <?= $form->field($model, 'rememberMe')->checkbox() ?>

                        <div class="form-group">
                            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                            <div class="description help-block" > No tienes una cuenta?Registrate <a href="<?= Url::toRoute("site/create") ?>">Aqui</a></div>
                        </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</body>
