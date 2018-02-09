<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\spd\models\BookManageMainSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-manage-main-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bmm_id') ?>

    <?= $form->field($model, 'bmm_code') ?>

    <?= $form->field($model, 'bmm_title') ?>

    <?= $form->field($model, 'bmm_tid') ?>

    <?= $form->field($model, 'bmm_bid') ?>

    <?php // echo $form->field($model, 'bmm_eduyear') ?>

    <?php // echo $form->field($model, 'bmm_author') ?>

    <?php // echo $form->field($model, 'bmm_jointauthor') ?>

    <?php // echo $form->field($model, 'bmm_location') ?>

    <?php // echo $form->field($model, 'bmm_copy') ?>

    <?php // echo $form->field($model, 'bmm_note') ?>

    <?php // echo $form->field($model, 'bmm_file') ?>

    <?php // echo $form->field($model, 'bmm_date') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Html::icon('search').' '.'Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Html::icon('refresh').' '.'Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
