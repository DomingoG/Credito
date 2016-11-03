<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Administrativo */

$this->title = $model->departamento;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="administrativo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->iddepartamento], ['class' => 'btn btn-primary']) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'iddepartamento',
            'departamento',
            'encargado',
            'telefono',
            'usuario0.username',
        ],
    ]) ?>

</div>
