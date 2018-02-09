<?php

namespace backend\modules\spd\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\spd\models\BookManageMain;

/**
 * BookManageMainSearch represents the model behind the search form about `backend\modules\spd\models\BookManageMain`.
 */
class DfIndexSearch extends BookManageMain
{
    /**
     * @inheritdoc
     */
	  
	 /* adzpire gridview relation sort-filter
		public $weu;
		public $wecr;
	 
		add rule
		[['weu', 'wecr'], 'safe'],

		in function search()  //weU = wasterecycle_user userPro = user_profile
		$query->joinWith(['weU', 'weCr.userPro']); // weCr.userPro - 2layer relation
		$dataProvider->sort->attributes['weu'] = [
			'asc' => ['wasterecycle_user.wu_name' => SORT_ASC],
			'desc' => ['wasterecycle_user.wu_name' => SORT_DESC],
		];
		$dataProvider->sort->attributes['wecr'] = [
			'asc' => ['user_profile.firstname' => SORT_ASC],
			'desc' => ['user_profile.firstname' => SORT_DESC],
		];
		//add grid filter condition ->orFilterWhere for search wu_name or wu_lastname
		->andFilterWhere(['like', 'wasterecycle_user.wu_name', $this->weu])
		->orFilterWhere(['like', 'wasterecycle_user.wu_lastname', $this->weu])
		->andFilterWhere(['like', 'user_profile.firstname', $this->wecr])
		->orFilterWhere(['like', 'user_profile.lastname', $this->wecr]);
        
	 */

    public function rules()
    {
        return [
            [['bmm_id', 'bmm_tid', 'bmm_bid', 'bmm_location', 'bmm_copy', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
            [['bmm_code', 'bmm_title', 'bmm_eduyear', 'bmm_author', 'bmm_jointauthor', 'bmm_note', 'bmm_file','searchauthor'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        if(!$params){
            $query = BookManageMain::find()->limit(5);
        }else{
            $query = BookManageMain::find();
        }


        // add conditions that should always apply here

        if(!$params){
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => false,
                'sort' => [
                    'defaultOrder' => [
                        'bmm_id' => SORT_DESC,
                    ]
                ]
            ]);
        }else{
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => false,
                'sort' => [
                    'defaultOrder' => [
                        'bmm_id' => SORT_DESC,
                    ]
                ]
            ]);
        }


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'bmm_id' => $this->bmm_id,
            'bmm_tid' => $this->bmm_tid,
            'bmm_bid' => $this->bmm_bid,
            'bmm_eduyear' => $this->bmm_eduyear,
            'bmm_location' => $this->bmm_location,
            'bmm_copy' => $this->bmm_copy,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'bmm_code', $this->bmm_code])
            ->andFilterWhere(['like', 'bmm_title', $this->bmm_title])
            ->andFilterWhere(['like', 'bmm_author', $this->bmm_author])
            ->andFilterWhere(['like', 'bmm_jointauthor', $this->bmm_jointauthor])
            ->andFilterWhere(['like', 'bmm_note', $this->bmm_note])
            ->andFilterWhere(['like', 'bmm_file', $this->bmm_file])
            ->andFilterWhere(['like', 'bmm_author', $this->searchauthor])
            ->orFilterWhere(['like', 'bmm_jointauthor', $this->searchauthor]);
        return $dataProvider;
    }
}
