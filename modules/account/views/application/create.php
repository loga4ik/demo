<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\application $model */

$this->title = 'Создать заявку';
$this->params['breadcrumbs'][] = ['label' => 'мои заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="application-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
