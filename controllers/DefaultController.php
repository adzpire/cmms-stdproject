<?php

namespace backend\modules\spd\controllers;

use backend\modules\spd\models\BookManageMain;
use backend\modules\spd\models\BookManageMainSearch;
use backend\modules\spd\models\BookManageLocation;
use backend\modules\spd\models\BookManageType;
use backend\modules\spd\models\DfIndexSearch;
use backend\modules\branch\models\Branch;
use Yii;
use yii\web\Controller;
use yii\helpers\Url;
/**
 * Default controller for the `spd` module
 */
class DefaultController extends Controller
{
    public $moduletitle;
    public function beforeAction($action){
        $this->moduletitle = Yii::t('app', Yii::$app->controller->module->params['title']);
        return parent::beforeAction($action);
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        Yii::$app->view->title = $this->moduletitle;

//        $searchModel = new DfIndexSearch();
//
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $searchModel = new BookManageMainSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if(!Yii::$app->request->queryParams){
            $dataProvider->query = $searchModel->find()->limit(5);

            $dataProvider->sort = [
                'defaultOrder' => [
                    'bmm_id' => SORT_DESC,
                ]
            ];
            $dataProvider->pagination = false;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'llist' => BookManageLocation::getBookManageLocationList(),
            'tlist' => BookManageType::getBookManageTypeList(),
            'blist' => Branch::getBranchList(),
        ]);
    }

    public function actionDownload($id)
    {
        $file = $this->findModel($id)->bmm_file;
        $storagePath = Yii::getAlias('@uploads/spd_files/');

        return \Yii::$app->response->sendFile(Yii::getAlias("$storagePath/$file"));
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        Yii::$app->view->title = Yii::t('app', 'ดูรายละเอียด') . ' : ' .$model->bmm_id.' - '. $this->moduletitle;

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = BookManageMain::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('ไม่พบหน้าที่ต้องการ.');
        }
    }

    public function actionReadme()
    {
        return $this->render('readme');
    }
    public function actionChangelog()
    {
        return $this->render('changelog');
    }
    public function actionSetvercookies()
    {
        $cookie = \Yii::$app->response->cookies;
        $cookie->add(new \yii\web\Cookie([
            'name' => \Yii::$app->controller->module->params['modulecookies'],
            'value' => \Yii::$app->controller->module->params['ModuleVers'],
            'expire' => time() + (60*60*24*30),
        ]));
        $this->redirect(Url::previous());
    }
}
