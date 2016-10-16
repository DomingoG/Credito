<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CreditosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Creditos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="creditos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Creditos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idcredito',
            'actividad',
            'credito',
            'periodo',
            'comentario:ntext',
            // 'responsable',
            // 'obligatorio',
            // 'limite',
            // 'imagen',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
