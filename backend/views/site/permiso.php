<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
    <p>No tiene permiso para acceder a esta página.</p>
    </div>
    <?= Html::button('Volver', [
            'name' => 'btnBack',
            'class'=>'btn btn-danger',
            'style' => 'width:150px;',
            'onclick' => "history.go(-1)",
                ]
                );
    ?>
    
</div>

