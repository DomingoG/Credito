<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Alumcreditos */

$this->title = 'Create Alumcreditos';
$this->params['breadcrumbs'][] = ['label' => 'Alumcreditos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alumcreditos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
