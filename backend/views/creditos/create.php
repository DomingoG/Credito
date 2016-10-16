<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Creditos */

$this->title = 'Create Creditos';
$this->params['breadcrumbs'][] = ['label' => 'Creditos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="creditos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
