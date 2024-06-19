<?php

use app\models\Department;
use app\models\Status;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\ApplicationSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="application-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'department_id')->dropDownList(Department::getDepartment(), ['prompt' => 'выберите отдел']) ?>

    <?= $form->field($model, 'status_id')->dropDownList(Status::getStatus(), ['prompt' => 'выберите статус']) ?>

    <?php // echo $form->field($model, 'date') 
    ?>

    <?php // echo $form->field($model, 'created_at') 
    ?>

    <div class="form-group">
        <?= Html::submitButton('найти', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('сбросить','./', ['class' => 'btn btn-outline-secondary']) ?>
        <?= Html::submitButton('на сегодня', ['class' => 'btn btn-outline-primary', 'name' => 'date', 'value' => 'true']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
