<?php

use yii\bootstrap\Html;
//use kartik\widgets\DatePicker;

use kartik\dynagrid\DynaGrid;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\spd\models\BookManageTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-manage-type-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	<?= DynaGrid::widget([
    'columns' => [
		//['class' => 'yii\grid\SerialColumn'],

		[
			'attribute' => 'bmt_id',
			'headerOptions' => [
				'width' => '50px',
			],
		],
		'bmt_code',
		'bmt_nameTh',
		'bmt_nameEng',
			[
				'class' => 'yii\grid\ActionColumn',
				'headerOptions' => [
					'width' => '70px',
				],
				'order'=>DynaGrid::ORDER_FIX_RIGHT,
				/*'visibleButtons' => [
					'view' => Yii::$app->user->id == 122,
					'update' => Yii::$app->user->id == 19,
					'delete' => function ($model, $key, $index) {
									return $model->status === 1 ? false : true;
								}
					],
				'visible' => Yii::$app->user->id == 19,*/
			],
	],	
    'theme'=>'panel-info',
    'showPersonalize'=>true,
	'storage' => 'session',
	'toggleButtonGrid' => [
		'label' => '<span class="glyphicon glyphicon-wrench">ปรับแต่งตาราง</span>'
	],
    'gridOptions'=>[
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        // 'showPageSummary'=>true,
        // 'floatHeader'=>true,
		'pjax'=>true,
		'hover'=>true,
		'pager' => [
			'firstPageLabel' => Yii::t('app', 'รายการแรกสุด'),
			'lastPageLabel' => Yii::t('app', 'รายการท้ายสุด'),
		],
		'resizableColumns'=>true,
        'responsiveWrap'=>false,
        'responsive'=>true,
        'panel'=>[
            'heading'=> Html::icon('folder-close').' '.Html::encode($this->title),
            // 'before' =>  '<div style="padding-top: 7px;"><em>* The table header sticks to the top in this demo as you scroll</em></div>',
			'after' => false,			
        ],
        'toolbar' =>  [
            ['content'=>
				Html::a(Html::icon('plus').' เพิ่มรายการ', ['create'], ['class'=>'btn btn-success', 'title'=>Yii::t('app', 'เพิ่ม')]).' '.
				Html::a(Html::icon('repeat'), ['grid-demo'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Reset Grid')])
			],                   
            ['content'=>'{dynagrid}'],
            '{toggleData}', 
		],
		
    ],
    'options'=>['id'=>'dynagrid-spdbtindex'] // a unique identifier is important
]); ?>

<?php 	 /* adzpire grid tips
		[
				'attribute' => 'id',
				'headerOptions' => [
					'width' => '50px',
				],
			],
		[
		'attribute' => 'we_date',
		'value' => 'we_date',
			'filter' => DatePicker::widget([
					'model'=>$searchModel,
					'attribute'=>'date',
					'language' => 'th',
					'options' => ['placeholder' => Yii::t('app', 'enterdate')],
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pickerButton' =>false,
					//'size' => 'sm',
					//'removeButton' =>false,
					'pluginOptions' => [
						'autoclose' => true,
						'format' => 'yyyy-mm-dd'
					]
				]),
			//'format' => 'html',			
			'format' => ['date']

		],	
		[
			'attribute' => 'we_creator',
			'value' => 'weCr.userPro.nameconcatened'
		],
	 */
 ?> 
</div>
