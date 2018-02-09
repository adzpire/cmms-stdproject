<?php

namespace backend\modules\spd\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "book_manage_location".
 *
 
 * @property integer $bml_id
 * @property string $bml_nameTh
 * @property string $bml_nameEng
 * @property BookManageMain[] $bookManageMains
 */
class BookManageLocation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book_manage_location';
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
            [['bml_nameTh'], 'required'],
            [['bml_nameTh', 'bml_nameEng'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bml_id' => 'Bml ID',
            'bml_nameTh' => 'สถานที่(ไทย)',
            'bml_nameEng' => 'สถานที่(อังกฤษ)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookManageMains()
    {
        return $this->hasMany(BookManageMain::className(), ['bmm_location' => 'bml_id']);
		
			/*
			$dataProvider->sort->attributes['bookManageMainsName'] = [
				'asc' => ['book_manage_location.name' => SORT_ASC],
				'desc' => ['book_manage_location.name' => SORT_DESC],
			];
			
			->andFilterWhere(['like', 'book_manage_location.name', $this->bookManageMainsName])
			->orFilterWhere(['like', 'book_manage_location.name1', $this->bookManageMainsName])

			in grid
			[
				'attribute' => 'bookManageMainsName',
				'value' => 'bookManageMains.name',
				'label' => $searchModel->attributeLabels()['bmm_location'],
				'filter' => \BookManageMain::bookManageMainsList,
			],
			*/
    }
	
	public function getBookManageMainsList()
    {
        $data = $this->bookManageMains;
        $doc = '<ul>';
        foreach($data as $key) {
            $doc .= '<li>'.$key->bmm_location.'</li>';
        }
        $doc .= '</ul>';
        return $doc;
    }

public static function getBookManageLocationList(){
		return ArrayHelper::map(self::find()->all(), 'bml_id', 'bml_nameTh');
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
