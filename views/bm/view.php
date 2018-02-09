<?php

use yii\bootstrap\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\spd\models\BookManageMain */

$this->params['breadcrumbs'][] = ['label' => 'หน้ารายการ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-manage-main-view">

<div class="panel panel-success">
	<div class="panel-heading">
		<span class="panel-title"><?= Html::icon('eye').' '.Html::encode($this->title) ?></span>
		<?= Html::a( Html::icon('fire').' '.'ลบ', ['delete', 'id' => $model->bmm_id], [
            'class' => 'btn btn-danger panbtn',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
		<?= Html::a( Html::icon('pencil').' '.'แก้ไข', ['update', 'id' => $model->bmm_id], ['class' => 'btn btn-primary panbtn']) ?>
		<?= Html::a( Html::icon('open-file').' '.'สร้างใหม่', ['create'], ['class' => 'btn btn-info panbtn']) ?>
	</div>
	<div class="panel-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
 			[
				'label' => $model->attributeLabels()['bmm_id'],
				'value' => $model->bmm_id,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['bmm_code'],
				'value' => $model->bmm_code,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['bmm_title'],
				'value' => $model->bmm_title,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['bmm_tid'],
				'value' => $model->bmmT->bmt_nameTh,
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['bmm_bid'],
				'value' => $model->bmmB->name_th,
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['bmm_eduyear'],
				'value' => function($model){
                    return $model->bmm_eduyear.' <span class="text-danger">('.($model->bmm_eduyear+543).')</span>';
                },
                'format' => 'html',
			],
     			[
				'label' => $model->attributeLabels()['bmm_author'],
				'value' => $model->bmm_author,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['bmm_jointauthor'],
				'value' => $model->bmm_jointauthor,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['bmm_location'],
				'value' => $model->bmmLocation->bml_nameTh,
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['bmm_copy'],
				'value' => $model->statusLabel,
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['bmm_note'],
				'value' => $model->bmm_note,
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['bmm_file'],
				//'value' => $model->bmm_file,
				'value' => function($model){
				    if(!empty($model->bmm_file)){
                        return Html::a('ดาวน์โหลด', '/uploads/spd_files/'.$model->bmm_file, ['target'=> '_blank']);
                    }
				    return 'ไม่มี';
                },
				'format' => ['raw']
			],
     			[
				'label' => $model->attributeLabels()['created_by'],
				'value' => $model->createdBy->fullname,
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['created_at'],
				'value' => $model->created_at,			
				'format' => ['date']
			],
     			[
				'label' => $model->attributeLabels()['updated_by'],
				'value' => $model->updatedBy->fullname,
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['updated_at'],
				'value' => $model->updated_at,
                'format' => ['date']
			],
    	],
    ]) ?>
	</div>
</div>
</div>