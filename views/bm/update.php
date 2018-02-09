<?php

use yii\bootstrap\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\spd\models\BookManageMain */

$this->params['breadcrumbs'][] = ['label' => 'หน้ารายการ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bmm_id, 'url' => ['view', 'id' => $model->bmm_id]];
$this->params['breadcrumbs'][] = 'อัพเดต';
?>
<div class="book-manage-main-update">

    <div class="panel panel-warning">
        <div class="panel-heading">
            <span class="panel-title"><?= Html::icon('edit') . ' ' . Html::encode($this->title) ?></span>
            <?= Html::a(Html::icon('fire') . ' ' . 'ลบ', ['delete', 'id' => $model->bmm_id], [
                'class' => 'btn btn-danger panbtn',
                'data' => [
                    'confirm' => 'ต้องการลบข้อมูล?',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a(Html::icon('pencil') . ' ' . 'สร้างใหม่', ['create'], ['class' => 'btn btn-info panbtn']) ?>
        </div>
        <div class="panel-body">
            <?= $this->render('_form', [
                'model' => $model,
                'llist' => $llist,
                'tlist' => $tlist,
                'blist' => $blist,
            ]) ?>
        </div>
    </div>

</div>
