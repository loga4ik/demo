<?php

use app\models\Category;
use app\models\Department;
use app\models\Status;
use app\models\User;
use yii\bootstrap5\Html;

?>
<div class="card mb-3" style="width: 18rem;height:28rem">
    <div class="card-body">
        <h5 class="card-title">№: <?= $model->id ?></h5>
        <p class="card-text">категория: <?= Category::getCategory()[User::findIdentity($model->user_id)->category_id] ?></p>
        <p class="card-text">отдел: <?= Department::getDepartment()[$model->department_id] ?></p>
        <p class="card-text">статус <?= Status::getStatus()[$model->status_id] ?></p>
        <p class="card-text">описание: <?= $model->description ?></p>
        <p class="card-text">Дата приема: <?= Yii::$app->formatter->asDatetime($model->date, 'php:d.m.Y H:i:s') ?></p>
        <p class="card-text">Дата создания: <?= Yii::$app->formatter->asDatetime($model->created_at, 'php:d.m.Y H:i:s') ?></p>
        <?= Html::a('просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-primary m-1']) ?>
        <?= $model->status_id == 1 || $model->status_id == 2 ? Html::a('выполнить', ['complited', 'id' => $model->id], ['class' => 'btn btn-outline-success m-1']) : "" ?>
        <?= $model->status_id == 1 ? Html::a('в процесс', ['process', 'id' => $model->id], ['class' => 'btn btn-outline-warning m-1']) : "" ?>
        <?= $model->status_id == 1 ? Html::a('отменить', ['deny', 'id' => $model->id], ['class' => 'btn btn-outline-danger m-1']) : "" ?>
    </div>
</div>