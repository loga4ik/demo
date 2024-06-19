<?php

use app\models\Category;
use app\models\Department;
use app\models\Status;
use app\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\application $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="application-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('назад', ['./'], ['class' => 'btn btn-primary']) ?>
    </p>
    <p>
        <?= $model->status_id == 1 ? Html::a('удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'вы уверены?',
                'method' => 'post',
            ],
        ]) : '' ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            // [
            //     'attribute' => 'user_id',
            //     'value' => User::findIdentity($model->user_id)->full_name
            // ],
            [
                'label' => 'категория',
                'value' => Category::getCategory()[User::findIdentity($model->user_id)->category_id]
            ],
            [
                'attribute' => 'department_id',
                'value' => Department::getDepartment()[$model->department_id],
            ],
            [
                'attribute' => 'status_id',
                'value' => Status::getStatus()[$model->status_id],
            ],
            'description:ntext',
            [
                'attribute' => 'date',
                'value' => Yii::$app->formatter->asDatetime($model->date, 'php:d.m.Y H:i:s'),
            ],
            [
                'attribute' => 'created_at',
                'value' => Yii::$app->formatter->asDatetime($model->created_at, 'php:d.m.Y H:i:s'),
            ],
        ],
    ]) ?>

</div>