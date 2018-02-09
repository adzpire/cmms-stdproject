<?php

namespace backend\modules\spd\controllers;

use Yii;
use backend\modules\spd\models\BookManageMain;
use backend\modules\spd\models\BookManageMainSearch;
use backend\modules\spd\models\BookManageLocation;
use backend\modules\spd\models\BookManageType;
use backend\modules\branch\models\Branch;
use backend\components\AdzpireComponent;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/**
 * BmController implements the CRUD actions for BookManageMain model.
 */
class BmController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
//                'only' => ['update'],
//                'user' => ,
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
//                        'actions' => ['login', 'signup'],
                        'roles' => ['Staff'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['Student'],
                        'matchCallback' => function ($rule, $action) {
                            if ($this->findModel(Yii::$app->request->get('id'))->created_by == Yii::$app->user->id) {
                                return true;
                            }
                            return false;
                        }
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create', 'index', 'view'],
                        'roles' => ['Student'],
                    ],
                    // everything else is denied by default
                ],
            ],
        ];
    }

	public $moduletitle;
    public function beforeAction($action){
        $this->moduletitle = Yii::t('app', Yii::$app->controller->module->params['title']);

        return parent::beforeAction($action);
		  /* 
        if(ArrayHelper::isIn(Yii::$app->user->id, Yii::$app->controller->module->params['adminModule'])){
            //echo 'you are passed';
        }else{
            throw new ForbiddenHttpException('You have no right. Must be admin module.');
        }
        */
    }
	 
    /**
     * Lists all BookManageMain models.
     * @return mixed
     */
    public function actionIndex()
    {
		 
		 Yii::$app->view->title = 'รายการหนังสือ - '. $this->moduletitle;
		 
        $searchModel = new BookManageMainSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if(\Yii::$app->user->can('Student')){
            $mdl = BookManageMain::find()->where(['created_by' => Yii::$app->user->id])->one();
        }
        return $this->render('index', [
            'mdl' => $mdl,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'llist' => BookManageLocation::getBookManageLocationList(),
            'tlist' => BookManageType::getBookManageTypeList(),
            'blist' => Branch::getBranchList(),
        ]);
    }

    /**
     * Displays a single BookManageMain model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		 $model = $this->findModel($id);
		 
		 Yii::$app->view->title = Yii::t('app', 'ดูรายละเอียด') . ' : ' .$model->bmm_id.' - '. $this->moduletitle;
		 
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new BookManageMain model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		 Yii::$app->view->title = Yii::t('app', 'สร้างใหม่') .' - '. $this->moduletitle;
		 
        $model = new BookManageMain();

		/* if enable ajax validate
		if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			return ActiveForm::validate($model);
		}*/
		
        if ($model->load(Yii::$app->request->post())) {
			if($model->save()){
				AdzpireComponent::succalert('addflsh', 'เพิ่มรายการใหม่เรียบร้อย');
				return $this->redirect(['view', 'id' => $model->bmm_id]);	
			}else{
				AdzpireComponent::dangalert('addflsh', 'เพิ่มรายการไม่ได้');
			}
            print_r($model->getErrors());exit();
        }

        $mdl = BookManageMain::find()->where(['created_by' => Yii::$app->user->id])->one();
        if($mdl){
            AdzpireComponent::dangalert('addflsh', 'มีรายการอยู่แล้ว สามารถอัพเดตได้เท่านั้น');
            return $this->redirect(['update', 'id' => $mdl->bmm_id]);
        }


            return $this->render('create', [
                'model' => $model,
                'llist' => BookManageLocation::getBookManageLocationList(),
                'tlist' => BookManageType::getBookManageTypeList(),
                'blist' => Branch::getBranchList(),
            ]);
        

    }

    /**
     * Updates an existing BookManageMain model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		 $model = $this->findModel($id);
		 
		 Yii::$app->view->title = 'ปรับปรุงรายการประเภทหนังสือ: ' . $model->bmm_id.' - '. $this->moduletitle;
		 
        if ($model->load(Yii::$app->request->post())) {
			if($model->save()){
				AdzpireComponent::succalert('edtflsh', 'ปรับปรุงรายการเรียบร้อย');
			return $this->redirect(['view', 'id' => $model->bmm_id]);	
			}else{
				AdzpireComponent::dangalert('edtflsh', 'ปรับปรุงรายการไม่ได้');
			}
            print_r($model->getErrors());exit();
        } 

            return $this->render('update', [
                'model' => $model,
                'llist' => BookManageLocation::getBookManageLocationList(),
                'tlist' => BookManageType::getBookManageTypeList(),
                'blist' => Branch::getBranchList(),
            ]);
        

    }

    /**
     * Deletes an existing BookManageMain model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
		if($model->delete()){
            AdzpireComponent::succalert('edtflsh', 'ลบรายการเรียบร้อย');
        }else{
            AdzpireComponent::dangalert('edtflsh', 'ลบรายการไม่ได้ ติดต่อผู้ดูแลระบบ');
        }


        return $this->redirect(['index']);
    }

    /**
     * Finds the BookManageMain model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BookManageMain the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BookManageMain::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('ไม่พบหน้าที่ต้องการ.');
        }
    }
}
