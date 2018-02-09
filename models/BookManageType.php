<?php

namespace backend\modules\spd\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "book_manage_type".
 *
 
 * @property integer $bmt_id
 * @property string $bmt_code
 * @property string $bmt_nameTh
 * @property string $bmt_nameEng
 * @property BookManageMain[] $bookManageMains
 */
class BookManageType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book_manage_type';
    }

public $bookManageMainsName; 
/*add rule in [safe]
'bookManageMainsName', 
join in searh()
$query->joinWith(['bookManageMains', ]);*/
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bmt_code', 'bmt_nameTh'], 'required'],
            [['bmt_code', 'bmt_nameTh', 'bmt_nameEng'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bmt_id' => 'Bmt ID',
            'bmt_code' => 'รหัสประเภท',
            'bmt_nameTh' => 'ชื่อประเภท(ไทย)',
            'bmt_nameEng' => 'ชื่อประเภท(อังกฤษ)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookManageMains()
    {
        return $this->hasMany(BookManageMain::className(), ['bmm_tid' => 'bmt_id']);
		
			/*
			$dataProvider->sort->attributes['bookManageMainsName'] = [
				'asc' => ['book_manage_type.name' => SORT_ASC],
				'desc' => ['book_manage_type.name' => SORT_DESC],
			];
			
			->andFilterWhere(['like', 'book_manage_type.name', $this->bookManageMainsName])
			->orFilterWhere(['like', 'book_manage_type.name1', $this->bookManageMainsName])

			in grid
			[
				'attribute' => 'bookManageMainsName',
				'value' => 'bookManageMains.name',
				'label' => $searchModel->attributeLabels()['bmm_tid'],
				'filter' => \BookManageMain::bookManageMainsList,
			],
			*/
    }
	
	public function getBookManageMainsList()
    {
        $data = $this->bookManageMains;
        $doc = '<ul>';
        foreach($data as $key) {
            $doc .= '<li>'.$key->bmm_tid.'</li>';
        }
        $doc .= '</ul>';
        return $doc;
    }

public static function getBookManageTypeList(){
		return ArrayHelper::map(self::find()->all(), 'bmt_id', 'bmt_nameTh');
	}

/*


public static function itemsAlias($key) {
        $items = [
            'status' => [
                0 => Yii::t('app', 'ร่าง'),
                1 => Yii::t('app', 'เสนอ'),
                2 => Yii::t('app', 'อนุมัติ'),
                3 => Yii::t('app', 'ไม่อนุมัติ'),
                4 => Yii::t('app', 'คืนแล้ว'),
            ],
            'statusCondition'=>[
                1 => Yii::t('app', 'อนุมัติ'),
                0 => Yii::t('app', 'ไม่อนุมัติ'),
            ]
        ];
        return ArrayHelper::getValue($items, $key, []);
    }

    public function getStatusLabel() {
        $status = ArrayHelper::getValue($this->getItemStatus(), $this->status);
        $status = ($this->status === NULL) ? ArrayHelper::getValue($this->getItemStatus(), 0) : $status;
        switch ($this->status) {
            case 0 :
            case NULL :
                $str = '<span class="label label-warning">' . $status . '</span>';
                break;
            case 1 :
                $str = '<span class="label label-primary">' . $status . '</span>';
                break;
            case 2 :
                $str = '<span class="label label-success">' . $status . '</span>';
                break;
            case 3 :
                $str = '<span class="label label-danger">' . $status . '</span>';
                break;
            case 4 :
                $str = '<span class="label label-succes">' . $status . '</span>';
                break;
            default :
                $str = $status;
                break;
        }

        return $str;
    }

    public static function getItemStatus() {
        return self::itemsAlias('status');
    }
    
    public static function getItemStatusConsider() {
        return self::itemsAlias('statusCondition');       
    }
*/
}
