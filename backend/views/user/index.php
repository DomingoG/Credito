<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nuevo Usuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
             'email:email',
            // 'created_at',
            // 'updated_at',
  //           'role_id',
//             'user_type_id',
           //  'status_id',
             
              [
            'attribute' => 'status.status_name',
            'label' => 'Estado',
            'format' => 'raw',
            'content'=>function($data){##data accesso a toda fila
           return $data->getStatusname();
            },
            ],

            [
            'attribute' => 'role.role_name',
            'label' => 'Usuario',
            'format' => 'raw',
            'content'=>function($data){##data accesso a toda fila
           return $data->getRolename();
            },
            ],

            [
            'attribute' => 'user_type.user_type_name',
            'label' => 'Tipo de usuario',
            'format' => 'raw',
            'content'=>function($data){##data accesso a toda fila
           return $data->getTypename();
            },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
