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
        'layout' => 'horizontal',
        'fieldConfig' => [
            'horizontalCssClasses' => [
            'label' => 'col-md-2',
            'wrapper' => 'col-md-10',
            ],
        ],
    ]); ?>

    <?php // $form->field($model, 'bmm_id') ?>

    <?= $form->field($model, 'bmm_code') ?>

    <?php //print_r($tlist);exit();
    echo $form->field($model, 'bmm_tid')->dropDownList($tlist, ['prompt'=>'-- ทั้งหมด --']);
    ?>

    <?php
    echo $form->field($model, 'bmm_bid')->dropDownList($blist, ['prompt'=>'-- ทั้งหมด --']);
    ?>

    <?= $form->field($model, 'bmm_title') ?>

    <?php echo $form->field($model, 'searchauthor') ?>

    <?php echo $form->field($model, 'bmm_eduyear') ?>

    <?php
    echo $form->field($model, 'bmm_location')->dropDownList($llist, ['prompt'=>'-- ทั้งหมด --']);
    ?>

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

    <div class="form-group text-center">
        <?= Html::submitButton(Html::icon('search').' '.'ค้นหา', ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
