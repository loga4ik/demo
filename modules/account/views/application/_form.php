<?php

use app\models\Department;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\application $model */
/** @var yii\widgets\ActiveForm $form */
$time = [
    '08:00:00' => '08:00',
    '09:00:00' => '09:00',
    '10:00:00' => '10:00',
    '11:00:00' => '11:00',
    '12:00:00' => '12:00',
    '13:00:00' => '13:00',
    '14:00:00' => '14:00',
    '15:00:00' => '15:00',
    '16:00:00' => '16:00',
    '17:00:00' => '17:00',
    '18:00:00' => '18:00',
];
?>

<div class="application-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'department_id')->dropDownList(Department::getDepartment(), ['prompt' => 'выберите отдел']) ?>

    <?= $form->field($model, 'date')->textInput(['type' => 'date', 'min' => date('Y-m-d')]) ?>

    <?= $form->field($model, 'time')->dropDownList($time) ?>

    <div class="form-group">
        <?= Html::submitButton('отправить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>