<?php

use app\models\Category;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var ActiveForm $form */
?>
<div class="site-register">

    <?php $form = ActiveForm::begin([
        'id' => 'contact-form',
        'enableAjaxValidation' => true,
    ]); ?>

    <?= $form->field($model, 'full_name') ?>
    <?= $form->field($model, 'login') ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'category_id')->dropDownList(Category::getCategory()) ?>
    <?= $form->field($model, 'pasport')->widget(\yii\widgets\MaskedInput::class, [
        'mask' => '9999 999999',
    ]) ?>
    <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::class, [
        'mask' => '+7(999)-999-99-99',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('зарегистрироваться', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-register -->