<?php

use yii\bootstrap\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\spd\models\BookManageType */

$this->params['breadcrumbs'][] = ['label' => 'หน้ารายการ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-manage-type-view">

<div class="panel panel-success">
	<div class="panel-heading">
		<span class="panel-title"><?= Html::icon('eye').' '.Html::encode($this->title) ?></span>
		<?= Html::a( Html::icon('fire').' '.'Delete', ['ลบ', 'id' => $model->bmt_id], [
            'class' => 'btn btn-danger panbtn',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
		<?= Html::a( Html::icon('pencil').' '.'แก้ไข', ['update', 'id' => $model->bmt_id], ['class' => 'btn btn-primary panbtn']) ?>
		<?= Html::a( Html::icon('open-file').' '.'สร้างใหม่', ['create'], ['class' => 'btn btn-info panbtn']) ?>
	</div>
	<div class="panel-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
 			[
				'label' => $model->attributeLabels()['bmt_id'],
				'value' => $model->bmt_id,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['bmt_code'],
				'value' => $model->bmt_code,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['bmt_nameTh'],
				'value' => $model->bmt_nameTh,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['bmt_nameEng'],
				'value' => $model->bmt_nameEng,			
				//'format' => ['date', 'long']
			],
    	],
    ]) ?>
	</div>
</div>
</div>