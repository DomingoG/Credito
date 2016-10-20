<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdministrativoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Administrativos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="administrativo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Administrativo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'iddepartamento',
            'departamento',
            'encargado',
            'telefono',
            [
            'attribute' => 'user.username',
            'label' => 'Usuario',
            'format' => 'raw',
            'content'=>function($data){##data accesso a toda fila
           return $data->getUsername();
            },
            ],
            //'usuario0.username',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
