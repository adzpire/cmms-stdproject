<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\spd\models\BookManageTypeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-manage-type-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bmt_id') ?>

    <?= $form->field($model, 'bmt_code') ?>

    <?= $form->field($model, 'bmt_nameTh') ?>

    <?= $form->field($model, 'bmt_nameEng') ?>

    <div class="form-group">
        <?= Html::submitButton(Html::icon('search').' '.'Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Html::icon('refresh').' '.'Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
