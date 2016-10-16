<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
?>
<?php
$this->title = 'Lista Avisos';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Avisos</h1>
<p>
        <?= Html::a('Create Avisos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>    

<?= GridView::widget([
        'dataProvider' => $provider,
        //'filterModel' => $searchModel,
         'options'=>['style'=>'overflow: auto'],//tabla auto ajustable a la pantalla
         'headerRowOptions'=>['class'=>'kartik-sheet-style'],
         'filterRowOptions'=>['class'=>'kartik-sheet-style'],
         'showFooter'=>true,
         'showHeader' => true,
         'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'informacion',
            'fecha',
            'actividad',
               
            ['class' => 'yii\grid\ActionColumn',

             'contentOptions' => ['style' => 'width:260px;'],
              'header'=>'Actions',
              'template' => '{view} {delete}',
             'buttons' => [

            //view button
            'view' => function ($url, $model) {
                return Html::a('<span class="fa fa-search"></span>View',['view','id'=>$model['idavisos']], 
                            [
                            'title' => Yii::t('app', 'View'),                            
                            'class'=>'btn btn-primary btn-xs',                                  
                           ]);
            },

            //view delete
            'delete' => function ($url, $model) {
                return Html::a('<span class="fa fa-search"></span>Eliminar',['delete','id'=>$model['idavisos']], 
                            [
                            'title' => Yii::t('app', 'Eliminar'),                            
                            'class'=>'btn btn-danger btn-xs',   
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],                               
                           ]);
            },



        ],

    
            
             ],
            
            
        ],
         'options'=>['class'=>'grid-view gridview-newclass'],
    
    ]); ?>