<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;
use kartik\widgets\DatePicker;
use kartik\widgets\FileInput;
/*

use kartik\widgets\ActiveForm;

*/
/* @var $this yii\web\View */
/* @var $model backend\modules\spd\models\BookManageMain */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-manage-main-form">

    <?php $form = ActiveForm::begin([
			'layout' => 'horizontal', 
			'id' => 'book-manage-main-form',
//			'fieldConfig' => [
//			'horizontalCssClasses' => [
//				'label' => 'col-md-4',
//				'wrapper' => 'col-sm-8',
//				],
//			],
			//'validateOnChange' => true,
            //'enableAjaxValidation' => true,
			//	'enctype' => 'multipart/form-data'
			]); ?>

    <?php if(!$model->isNewRecord){ ?>
        <div class="form-group">
            <label class="control-label col-sm-3" >รหัสหนังสือ</label>
            <div class="col-sm-6 text-danger">
                <?php echo $model->bmm_code; ?>
            </div>

        </div>
    <?php } ?>

    <?= $form->field($model, 'bmm_title')->textInput(['maxlength' => true]) ?>

    <?php //print_r($tlist);exit();
        echo $form->field($model, 'bmm_tid')->dropDownList($tlist);
    ?>

    <?php
        echo $form->field($model, 'bmm_bid')->dropDownList($blist);
    ?>

    <?= $form->field($model, 'bmm_eduyear')->widget(DatePicker::classname(), [
					'language' => 'th',
					'options' => ['placeholder' => 'เลือกวันที่'],
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
						'autoclose'=>true,
                        'format' => 'yyyy',
                        'startView'=>'years',
                        'minViewMode'=>'years',
					]]) ?>

    <?= $form->field($model, 'bmm_author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bmm_jointauthor')->textarea(['rows' => 6])->hint('<span class="text-danger">ให้ใส่ชื่อแล้วตามด้วยเครื่องหมาย , ไม่ต้องเว้นวรรค เช่น ชื่อ นามสกุล,สมชาย มั่นคง,สมหญิง อ่อนหวาน</span>') ?>

    <?php
        echo $form->field($model, 'bmm_location')->dropDownList($llist);
    ?>

    <?= $form->field($model, 'bmm_copy')->inline()->radioList($model::getCopyStatus())->inline() ?>

    <?= $form->field($model, 'bmm_note')->textarea(['rows' => 6]) ?>

    <?php
    if(!$model->isNewRecord) {
        echo $form->field($model, 'bmm_file')->widget(
            \adzpire\basicfilemanager\widgets\BfmTextInput::className(),
            [
                'browserUrl' => '/basicfilemanager',
                'returnType' => 'basename',
                //'modalOptions' => ['id' => 'modal-post-thumbnail'],
                'options' => [
                    'subDir' => 'spd_files', //บังคับเข้า dir ตามค่า (default='')
                    'changeDir' => false, //การอนุญาตให้เปลี่ยน dir ได้ (default=true)
                    'createDir' => false, //การอนุญาติให้สร้าง dir ได้ (default=true)
                    'upload' => true, //การอนุญาติให้ upload ได้ (default=true)
                    'selectFileOnly' => true,
                    'hidePreview' => true,
                    'pattern' => [$model->bmm_id, '_', $model->bmmT->bmt_code, '_', $model->bmm_eduyear]
//                'resizeOptions' => [  // comment when not image
//                    'keepratio'=> true,
//                    'width' => 800,
//                    'height' => 800,
//                ],
                ],
            ]
        );
    }else{ ?>
        <div class="form-group">
            <label class="control-label col-sm-3" >ไฟล์</label>
            <div class="col-sm-6 text-danger">
                ต้องบันทึกก่อนจึงจะสามารถอัพโหลดไฟล์ได้
            </div>
        </div>
    <?php }
    //    echo $form->field($model, 'bmm_file' ,[
    //        'inputTemplate' => !empty($model->bmm_file) ? '
    //				<div class="input-group">{input}
    //					<span class="input-group-btn">'.
    //            Html::a( Html::icon('download').' '.Yii::t('app', 'ดาวน์โหลด'), Url::to('@uploads/tc_files/'.$model->bmm_file), ['class' => 'btn btn-success', 'target' => '_blank'])
    //            .'</div>' : false,
    //    ] )->widget(FileInput::classname(), [
    //        'pluginOptions' => [
    //            'showPreview' => false,
    //            'showCaption' => true,
    //            'showRemove' => true,
    //            'initialCaption'=> $model->isNewRecord ? '' : $model->bmm_file,
    //            'showUpload' => false
    //        ]
    //    ]);
    ?>

<?php 		/* adzpire form tips
		$form->field($model, 'wu_tel', ['enableAjaxValidation' => true])->textInput(['maxlength' => true]);
		//file field
				echo $form->field($model, 'file',[
		'addon' => [
       
'append' => !empty($model->wt_image) ? [
			'content'=> Html::a( Html::icon('download').' '.Yii::t('app', 'download'), Url::to('@backend/web/'.$model->wt_image), ['class' => 'btn btn-success', 'target' => '_blank']), 'asButton'=>true] : false
    ]])->widget(FileInput::classname(), [
			//'options' => ['accept' => 'image/*'],
			'pluginOptions' => [
				'showPreview' => false,
				'showCaption' => true,
				'showRemove' => true,
				'initialCaption'=> $model->isNewRecord ? '' : $model->wt_image,
				'showUpload' => false
			]
]);
		*/
 ?>     <div class="form-group text-center">
        <?= Html::submitButton(Html::icon('floppy-disk').' '.'บันทึก', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		<?php if(!$model->isNewRecord){
		 echo Html::resetButton( Html::icon('refresh').' '.'เริ่มใหม่' , ['class' => 'btn btn-warning']); 
		 } ?>
		 
	</div>

    <?php ActiveForm::end(); ?>

</div>
