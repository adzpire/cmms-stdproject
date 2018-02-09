<?php
/**
 * Created by PhpStorm.
 * User: cmmsNetAdmin
 * Date: 8/1/2559
 * Time: 20:10
 */
use yii\helpers\Url;
use yii\bootstrap\Html;
use yii\bootstrap\Alert;
use yii\bootstrap\Button;

$test = Url::remember(Url::current());
//echo $test;
?>
<style>
    legend {
        margin-bottom: 5px;
        font-size: 16px;
    }
</style>
<?php
Alert::begin([
    'options' => [
        'class' => 'alert-custom',
    ],
]);
?>
<strong><?php echo Html::icon('info-sign'); ?> -: มีการอัพเดตระบบ :- </strong>
<?php echo Button::widget([
    'label' => 'แสดงรายละเอียด',
    'options' => [
        'class' => 'btn-xs btn-primary',
        'data-toggle' => 'collapse',
        'data-target' => '#demo',
    ],
]);
echo Html::a('ปิดการแจ้งเตือน 30 วัน', ['default/setvercookies'],
    [
        'class' => 'btn btn-xs btn-danger',
    ]);
?>
<div id="demo" class="collapse">
    <h4>เวอร์ชั่น <?php echo Yii::$app->controller->module->params['ModuleVers']; ?></h4>
    <?php echo $this->render('/_changelog'); ?>
    <?php
    echo Html::a('แสดงการปรับปรุงทั้งหมด', ['default/changelog'],
        [
            'class' => 'btn btn-xs btn-warning',
        ]);
    ?>
</div>

<?php Alert::end(); ?>