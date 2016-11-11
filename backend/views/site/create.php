<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\User */

?>
<body class="fondo">
    <div class="login-page">
        <div class="form">

		    <h1><?= Html::encode($this->title) ?></h1>

		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
	    </div>
   </div>
</body>

