<?php

use app\models\application;
use yii\bootstrap5\LinkPager;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\ApplicationSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Заявки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="application-index">
    
    <h1><?= Html::encode($this->title) ?></h1>
    <?=Html::a('отделы', '/admin/department', ['class' => 'btn btn-primary'])?>

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="m-5">
        <?= $dataProvider->sort->link('id') . '|' .
            $dataProvider->sort->link('user_id') . '|' .
            $dataProvider->sort->link('department_id') . '|' .
            $dataProvider->sort->link('status_id') . '|' .
            $dataProvider->sort->link('description') . '|' .
            $dataProvider->sort->link('date') . '|' .
            $dataProvider->sort->link('created_at') ?>
    </div>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'pager' => [
            'class' => LinkPager::class
        ],
        'layout' => '{pager}<div class="d-flex flex-wrap justify-content-between">{items}</div>',
        'itemView' => 'item',
    ]) ?>

    <?php Pjax::end(); ?>

</div>