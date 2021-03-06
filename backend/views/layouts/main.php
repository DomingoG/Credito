<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\helpers\Url;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use common\models\ValueHelpers;
use backend\assets\FontAwesomeAsset;

AppAsset::register($this);
//FontAwesomeAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
   <?php
    if (Yii::$app->user->isGuest) {?>
    <div class="container">
    <?= $content ?>
    </div>
    <?php
  }
  else{
    
    
			$is_admin = ValueHelpers::getRoleValue('Admin');
			
			$is_alumno = ValueHelpers::getRoleValue('Alumno');
			$is_superadmin = ValueHelpers::getRoleValue('SuperAdmin');

			if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id <= $is_alumno)
						{	NavBar::begin([

								'brandLabel' => 'ITSVA',
								'brandUrl' => Url::toRoute("site/index"),
								'options' => [
									'class' => 'navbar-inverse navbar-fixed-top',
								],
							]);
					}
          elseif(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id <= $is_admin) 
          {
            NavBar::begin([

                'brandLabel' => 'ITSVA',
                'brandUrl' => Url::toRoute("administrativo/homeadmin"),
                'options' => [
                  'class' => 'navbar-inverse navbar-fixed-top',
                ],
              ]);
          }
          elseif (!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id <= $is_superadmin) {
              NavBar::begin([

                'brandLabel' => 'ITSVA',
                'brandUrl' => Url::toRoute("user/homeuser"),
                'options' => [
                  'class' => 'navbar-inverse navbar-fixed-top',
                ],
              ]);
          }else {
							NavBar::begin([
								'brandLabel' => 'ITSVA',
								//'brandUrl' => Url::toRoute("user/homeuser"),
								'options' => [
										'class' => 'navbar-inverse navbar-fixed-top',
											 ],
											]);
							}
						/*	$menuItems = [
							   // ['label' => 'Home', 'url' => ['/site/index']],
							];*/
				 if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id <= $is_alumno) 
				  {
						$menuItems[] = ['label' => 'Perfil', 'url' => ['alumno/perfil']];
						$menuItems[] = ['label' => 'Reporte', 'url' => ['/site/report']];
						$menuItems[] = ['label' => 'Creditos', 'url' => ['/site/creditolista']];
				  }elseif(!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id <= $is_admin) 
				  {
					$menuItems[] = ['label' => 'Home', 'url' => ['/administrativo/homeadmin']];
					$menuItems[] = ['label' => 'Profiles', 'url' => ['administrativo/perfile']];
					$menuItems[] = ['label' => 'Reporte', 'url' => ['alumcreditos/aprobados']];
					$menuItems[] = ['label' => 'Avisos', 'url' => ['avisos/index']];
					$menuItems[] = ['label' => 'Creditos', 'url' => ['#'],
					  'items' => [
						['label' => 'Inscritos', 'url' => ['alumcreditos/inscritosalumno', 'tag' => 'new']],
						['label' => 'Aprobar', 'url' => ['alumcreditos/activaralumno', 'tag' => 'new']],
						['label' => 'Bajas', 'url' => ['alumcreditos/bajaalumno', 'tag' => 'popular']],
						],
						
					];
						
				  } elseif (!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id <= $is_superadmin) {
					   
					   $menuItems[] = ['label' => 'Home', 'url' => ['user/homeuser']];
					   //$menuItems[] = ['label' => 'Perfil', 'url' => ['administrativo/perfile']];
					   $menuItems[] = ['label' => 'Usuarios', 'url' => ['user/index']];
					   $menuItems[] = ['label' => 'Creditos', 'url' => ['/creditos/index']];
					   $menuItems[] = ['label' => 'Departamento', 'url' => ['/administrativo/index']];
					   $menuItems[] = ['label' => 'Carreras',
					'items' => [
						['label' => 'ISC', 'url' => ['alumcreditos/isc', 'tag' => 'new']],
						['label' => 'I.Civil', 'url' => ['alumcreditos/civil', 'tag' => 'new']],
						['label' => 'I.Admon', 'url' => ['alumcreditos/admon', 'tag' => 'new']],
						['label' => 'I.Industrial', 'url' => ['alumcreditos/industrial', 'tag' => 'new']],
						['label' => 'I.Ambiental', 'url' => ['alumcreditos/ambiental', 'tag' => 'new']],
						],
					  ];
				  }
				  if (Yii::$app->user->isGuest) {
						$menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
				  } else {
						$menuItems[] = ['label' =>
						'Logout (' . Yii::$app->user->identity->username .')' ,
						'url' => ['/site/logout'],
						'linkOptions' => ['data-method' => 'post']
						];
						
				  }
					echo Nav::widget([
						'options' => ['class' => 'navbar-nav navbar-right'],
						'items' => $menuItems,
					]);
					NavBar::end();
					?>

				<div class="container">
					<?= Breadcrumbs::widget([
						'links' => isset($this->params['breadcrumbs'])? $this->params['breadcrumbs'] : [],
					]) ?>
					<?= Alert::widget() ?>
					<?= $content ?>
				</div>
</div>

				<footer class="footer">
					<div class="container">
						<p class="pull-left">&copy; Instituto Tecnológico Superior de Valladolid <?= date('Y') ?></p>

						<p class="pull-right"><!--?= Yii::powered() ?--></p>
					</div>
				</footer>
 <?php } ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
