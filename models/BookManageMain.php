<?php

namespace backend\modules\spd\models;

use Yii;
use yii\helpers\ArrayHelper;

use backend\modules\branch\models\Branch;
use backend\modules\person\models\Person;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "book_manage_main".
 *
 
 * @property integer $bmm_id
 * @property string $bmm_code
 * @property string $bmm_title
 * @property integer $bmm_tid
 * @property integer $bmm_bid
 * @property string $bmm_eduyear
 * @property string $bmm_author
 * @property string $bmm_jointauthor
 * @property integer $bmm_location
 * @property integer $bmm_copy
 * @property string $bmm_note
 * @property string $bmm_file
 * @property string $bmm_date
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_by
 * @property integer $updated_at
 * @property BookManageType $bmmT
 * @property BookManageLocation $bmmLocation
 * @property MainBranch $bmmB
 * @property Person $createdBy
 * @property Person $updatedBy
 */
class BookManageMain extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book_manage_main';
    }

    public function behaviors()
    {
        return [
            BlameableBehavior::className(),
            TimestampBehavior::className(),
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($insert) {
            $countexstbk = self::find()->where(['bmm_eduyear' => $this->bmm_eduyear, 'bmm_tid' => $this->bmm_tid, 'bmm_bid' => $this->bmm_bid,])->count();
            $next = str_pad($countexstbk+1, 2, "0", STR_PAD_LEFT);
            $thaiyear = intval($this->bmm_eduyear)+543;
            $bookcode = $this->bmmB->acronym.$this->bmmT->bmt_code.$next.'/'.$thaiyear;
//            echo $bookcode;exit();
            return $this->bmm_code = $bookcode;
        }

        return true;
    }

    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }

        if(\Yii::$app->user->can('Student')){
//            if(Yii::$app->user->id != $this->created_by){
//                return false;
//            }
            return false;
        }else{
            return true;
        }

    }

public $bmmTName; 
public $bmmLocationName; 
public $bmmBName; 
public $createdByName; 
public $updatedByName;
public $searchauthor;
/*add rule in [safe]
'bmmTName', 'bmmLocationName', 'bmmBName', 'createdByName', 'updatedByName', 
join in searh()
$query->joinWith(['bmmT', 'bmmLocation', 'bmmB', 'createdBy', 'updatedBy', ]);*/
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bmm_title', 'bmm_tid', 'bmm_bid', 'bmm_eduyear', 'bmm_author', 'bmm_location', 'bmm_copy'], 'required'],
            [['bmm_tid', 'bmm_bid', 'bmm_location', 'bmm_copy', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
            [['bmm_eduyear'], 'safe'],
            [['bmm_jointauthor', 'bmm_note'], 'string'],
            [['bmm_code', 'bmm_title', 'bmm_author', 'bmm_file'], 'string', 'max' => 255],
            [['bmm_tid'], 'exist', 'skipOnError' => true, 'targetClass' => BookManageType::className(), 'targetAttribute' => ['bmm_tid' => 'bmt_id']],
            [['bmm_location'], 'exist', 'skipOnError' => true, 'targetClass' => BookManageLocation::className(), 'targetAttribute' => ['bmm_location' => 'bml_id']],
            [['bmm_bid'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['bmm_bid' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['created_by' => 'user_id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['updated_by' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bmm_id' => 'ID',
            'bmm_code' => 'รหัส',
            'bmm_title' => 'ชื่อเรื่อง',
            'bmm_tid' => 'ประเภท',
            'bmm_bid' => 'สาขาวิชา',
            'bmm_eduyear' => 'ปีการศึกษา(ค.ศ.)',
            'bmm_author' => 'ผู้แต่ง',
            'bmm_jointauthor' => 'ผู้แต่งร่วม',
            'bmm_location' => 'สถานที่เก็บ',
            'bmm_copy' => 'สำเนา',
            'bmm_note' => 'หมายเหตุ',
            'bmm_file' => 'ไฟล์',
            'searchauthor' => 'ผู้แต่งหรือผู้แต่งร่วม',
            'created_by' => 'สร้างโดย',
            'created_at' => 'สร้างเมื่อ',
            'updated_by' => 'อัพเดตโดย',
            'updated_at' => 'อัพเดตเมื่อ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmmT()
    {
        return $this->hasOne(BookManageType::className(), ['bmt_id' => 'bmm_tid']);
		
			/*
			$dataProvider->sort->attributes['bmmTName'] = [
				'asc' => ['book_manage_type.name' => SORT_ASC],
				'desc' => ['book_manage_type.name' => SORT_DESC],
			];
			
			->andFilterWhere(['like', 'book_manage_type.name', $this->bmmTName])
			->orFilterWhere(['like', 'book_manage_type.name1', $this->bmmTName])

			in grid
			[
				'attribute' => 'bmmTName',
				'value' => 'bmmT.name',
				'label' => $searchModel->attributeLabels()['bmm_tid'],
				'filter' => \BookManageType::bmmTList,
			],
			*/
    }
	
	public function getBmmTList()
    {
        $data = $this->bmmT;
        $doc = '<ul>';
        foreach($data as $key) {
            $doc .= '<li>'.$key->bmm_tid.'</li>';
        }
        $doc .= '</ul>';
        return $doc;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmmLocation()
    {
        return $this->hasOne(BookManageLocation::className(), ['bml_id' => 'bmm_location']);
		
			/*
			$dataProvider->sort->attributes['bmmLocationName'] = [
				'asc' => ['book_manage_location.name' => SORT_ASC],
				'desc' => ['book_manage_location.name' => SORT_DESC],
			];
			
			->andFilterWhere(['like', 'book_manage_location.name', $this->bmmLocationName])
			->orFilterWhere(['like', 'book_manage_location.name1', $this->bmmLocationName])

			in grid
			[
				'attribute' => 'bmmLocationName',
				'value' => 'bmmLocation.name',
				'label' => $searchModel->attributeLabels()['bmm_location'],
				'filter' => \BookManageLocation::bmmLocationList,
			],
			*/
    }
	
	public function getBmmLocationList()
    {
        $data = $this->bmmLocation;
        $doc = '<ul>';
        foreach($data as $key) {
            $doc .= '<li>'.$key->bmm_location.'</li>';
        }
        $doc .= '</ul>';
        return $doc;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmmB()
    {
        return $this->hasOne(Branch::className(), ['id' => 'bmm_bid']);
		
			/*
			$dataProvider->sort->attributes['bmmBName'] = [
				'asc' => ['main_branch.name' => SORT_ASC],
				'desc' => ['main_branch.name' => SORT_DESC],
			];
			
			->andFilterWhere(['like', 'main_branch.name', $this->bmmBName])
			->orFilterWhere(['like', 'main_branch.name1', $this->bmmBName])

			in grid
			[
				'attribute' => 'bmmBName',
				'value' => 'bmmB.name',
				'label' => $searchModel->attributeLabels()['bmm_bid'],
				'filter' => \MainBranch::bmmBList,
			],
			*/
    }
	
	public function getBmmBList()
    {
        $data = $this->bmmB;
        $doc = '<ul>';
        foreach($data as $key) {
            $doc .= '<li>'.$key->bmm_bid.'</li>';
        }
        $doc .= '</ul>';
        return $doc;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Person::className(), ['user_id' => 'created_by']);
		
			/*
			$dataProvider->sort->attributes['createdByName'] = [
				'asc' => ['person.name' => SORT_ASC],
				'desc' => ['person.name' => SORT_DESC],
			];
			
			->andFilterWhere(['like', 'person.name', $this->createdByName])
			->orFilterWhere(['like', 'person.name1', $this->createdByName])

			in grid
			[
				'attribute' => 'createdByName',
				'value' => 'createdBy.name',
				'label' => $searchModel->attributeLabels()['created_by'],
				'filter' => \Person::createdByList,
			],
			*/
    }
	
	public function getCreatedByList()
    {
        $data = $this->createdBy;
        $doc = '<ul>';
        foreach($data as $key) {
            $doc .= '<li>'.$key->created_by.'</li>';
        }
        $doc .= '</ul>';
        return $doc;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(Person::className(), ['user_id' => 'updated_by']);
		
			/*
			$dataProvider->sort->attributes['updatedByName'] = [
				'asc' => ['person.name' => SORT_ASC],
				'desc' => ['person.name' => SORT_DESC],
			];
			
			->andFilterWhere(['like', 'person.name', $this->updatedByName])
			->orFilterWhere(['like', 'person.name1', $this->updatedByName])

			in grid
			[
				'attribute' => 'updatedByName',
				'value' => 'updatedBy.name',
				'label' => $searchModel->attributeLabels()['updated_by'],
				'filter' => \Person::updatedByList,
			],
			*/
    }
	
	public function getUpdatedByList()
    {
        $data = $this->updatedBy;
        $doc = '<ul>';
        foreach($data as $key) {
            $doc .= '<li>'.$key->updated_by.'</li>';
        }
        $doc .= '</ul>';
        return $doc;
    }

public function getBookManageMainList(){
		return ArrayHelper::map(self::find()->all(), 'bmm_id', 'title');
	}




public static function itemsAlias($key) {
        $items = [
            'copy' => [
                0 => Yii::t('app', 'ไม่มี'),
                1 => Yii::t('app', 'มี'),
            ],
//            'statusCondition'=>[
//                1 => Yii::t('app', 'อนุมัติ'),
//                0 => Yii::t('app', 'ไม่อนุมัติ'),
//            ]
        ];
        return ArrayHelper::getValue($items, $key, []);
    }

    public function getStatusLabel() {
        $status = ArrayHelper::getValue($this->getCopyStatus(), $this->bmm_copy);
        $status = ($this->bmm_copy === NULL) ? ArrayHelper::getValue($this->getCopyStatus(), 0) : $status;
        switch ($this->bmm_copy) {
//            case 0 :
//            case NULL :
//                $str = '<span class="label label-warning">' . $status . '</span>';
//                break;
//            case 1 :
//                $str = '<span class="label label-primary">' . $status . '</span>';
//                break;
//            case 2 :
//                $str = '<span class="label label-success">' . $status . '</span>';
//                break;
//            case 3 :
//                $str = '<span class="label label-danger">' . $status . '</span>';
//                break;
//            case 4 :
//                $str = '<span class="label label-succes">' . $status . '</span>';
//                break;
            default :
                $str = $status;
                break;
        }

        return $str;
    }

    public static function getCopyStatus() {
        return self::itemsAlias('copy');
    }

}
