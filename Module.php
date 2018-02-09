<?php

namespace backend\modules\spd;

use Yii;
/**
 * spd module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\spd\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {

		Yii::$app->formatter->locale = 'th_TH';
		Yii::$app->formatter->calendar = \IntlDateFormatter::TRADITIONAL;

        /*if (!isset(Yii::$app->i18n->translations['repair'])) {
           Yii::$app->i18n->translations['repair'] = [
               'class' => 'yii\i18n\PhpMessageSource',
               'sourceLanguage' => 'en',
               'basePath' => 'backend\modules\mainjob/mainjob/messages'
           ];
       }
       */
        parent::init();

        $this->layout = 'spd';
        $this->params['ModuleVers'] = '2.0';
        $this->params['title'] = 'ฐานข้อมูลรายงานนักศึกษา';
        $this->params['modulecookies'] = 'spdck';
        // custom initialization code goes here
    }
}
