<?php

use yii\bootstrap\Html;
//use kartik\widgets\DatePicker;

use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\spd\models\BookManageMainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;
$this->registerCss("
.grid-view td {
    white-space: unset;
}
");
?>
<div class="book-manage-main-index">

    <?php if(\Yii::$app->user->can('Student')){ ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <span class="panel-title"><?= Html::icon('edit').' รายงานของนักศึกษา'; ?></span>
            </div>
            <div class="panel-body">
                <?php if(!empty($mdl)){
                    echo 'มีแล้วแก้ไข'.Html::a( Html::icon('pencil').' '.'แก้ไข', ['update', 'id' => $mdl->bmm_id], ['class' => 'btn btn-primary']);
                }else{
                    echo 'ยังไม่มีสร้างใหม่ '.Html::a(Html::icon('plus').'เพิ่มรายการ', ['create'], ['class'=>'btn btn-success']);
                } ?>
            </div>
        </div>
    <?php } ?>

<?php Pjax::begin(); ?>    <?= GridView::widget([
		//'id' => 'kv-grid-demo',
		'dataProvider'=> $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'bmm_id',
                'headerOptions' => [
                    'width' => '50px',
                ],
            ],
            'bmm_code',
            'bmm_title',
            [
                'attribute' => 'bmm_tid',
                'value' => 'bmmT.bmt_nameTh',
                'filter' => $tlist,
            ],
            [
                'attribute' => 'bmm_bid',
                'value' => 'bmmB.name_th',
                'filter' => $blist,
            ],
            // 'bmm_eduyear',
            // 'bmm_author',
            // 'bmm_jointauthor:ntext',
            [
                'attribute' => 'bmm_location',
                'value' => 'bmmLocation.bml_nameTh',
                'filter' => $llist,
            ],
            // 'bmm_copy',
            // 'bmm_note:ntext',
            // 'bmm_file',
            // 'bmm_date',
            // 'created_by',
            // 'created_at',
            // 'updated_by',
            // 'updated_at',
				[
					'class' => 'yii\grid\ActionColumn',
                    'headerOptions' => [
                        'width' => '70px',
                    ],
					/*'visibleButtons' => [
						'view' => Yii::$app->user->id == 122,
						'update' => Yii::$app->user->id == 19,
						'delete' => function ($model, $key, $index) {
										return $model->status === 1 ? false : true;
									}
						],*/
					'visible' => Yii::$app->user->can('Staff'),
				],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view}',
                    /*'visibleButtons' => [
                        'view' => Yii::$app->user->id == 122,
                        'update' => Yii::$app->user->id == 19,
                        'delete' => function ($model, $key, $index) {
                                        return $model->status === 1 ? false : true;
                                    }
                        ],*/
                    'visible' => Yii::$app->user->can('Student'),
                ],
        ],
		'pager' => [
			'firstPageLabel' => 'รายการแรกสุด',
			'lastPageLabel' => 'รายการท้ายสุด',
		],
		'responsive'=>true,
		'hover'=>true,
		'toolbar'=> [
			['content'=>
				Html::a(Html::icon('plus').'เพิ่มรายการ', ['create'], ['class'=>'btn btn-success', 'title'=>Yii::t('app', 'Add Book')]).' '.
				Html::a(Html::icon('repeat'), ['grid-demo'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Reset Grid')])
			],
			//'{export}',
			'{toggleData}',
		],
		'panel'=>[
			'type'=>GridView::TYPE_INFO,
			'heading'=> Html::icon('book').' '.Html::encode($this->title),
		],
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
 ?> <?php Pjax::end(); ?>	
</div>
