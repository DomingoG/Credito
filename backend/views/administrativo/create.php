<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Administrativo */

$this->title = 'Nuevo Departamento';
$this->params['breadcrumbs'][] = ['label' => 'Administrativos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="administrativo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
