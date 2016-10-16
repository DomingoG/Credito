<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AlumcreditosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Alumcreditos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alumcreditos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Alumcreditos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idreporte',
            'credito',
            'departamento',
            'alumno',
            'fecha',
            // 'aprobado',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
