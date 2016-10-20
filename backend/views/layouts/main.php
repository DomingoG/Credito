<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
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
    NavBar::begin([
        'brandLabel' => 'ITSVA',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Alumno', 'url' => ['/site/creditolista']],
        ['label' => 'departamento', 'url' => ['/administrativo/index']],
        ['label' => 'Creditos', 'url' => ['/creditos/index']],
        ['label' => 'SuperAdmin',
        'items' => [
            ['label' => 'ISC', 'url' => ['alumcreditos/isc', 'tag' => 'new']],
            ['label' => 'I.Civil', 'url' => ['alumcreditos/civil', 'tag' => 'new']],
            ['label' => 'I.Admon', 'url' => ['alumcreditos/admon', 'tag' => 'new']],
            ['label' => 'I.Industrial', 'url' => ['alumcreditos/industrial', 'tag' => 'new']],
            ['label' => 'I.Ambiental', 'url' => ['alumcreditos/ambiental', 'tag' => 'new']],
            ],
          ],

        ['label' => 'Administrativo', 'url' => ['#'],
        'items' => [
            ['label' => 'Inscritos', 'url' => ['alumcreditos/inscritosalumno', 'tag' => 'new']],
            ['label' => 'Aprobar', 'url' => ['alumcreditos/activaralumno', 'tag' => 'new']],
            ['label' => 'Bajas', 'url' => ['alumcreditos/bajaalumno', 'tag' => 'popular']],
            ['label' => 'Avisos', 'url' => ['avisos/index', 'tag' => 'popular']],
            ],
            
        ],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
