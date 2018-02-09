<?php
use yii\helpers\Markdown;
$this->title = 'คู่มือใช้งานเบื้องต้น';
$body = Yii::$app->controller->renderPartial('@backend/modules/'.Yii::$app->controller->module->id.'/docs/guide/basic-usage.md');
echo Markdown::process($body, 'extra');