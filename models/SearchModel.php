<?php


namespace app\models;


use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

class SearchModel extends ActiveRecord

{

    public  static function tableName()
    {
        return 'price';
    }
    public function rules()
    {
        return [
            [["ID_PR"], 'safe'],
            [["DATA", "PRICE", "ID_SPDOC", "NAME"], 'safe'],


        ];
    }

    public function search($params){
        $query = Price::find()->orderBy([
            'NAME' => SORT_ASC,

        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!($this->load($params) && $this->validate())) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere(['ID_PR' => $this->ID_PR]);
        $query->andFilterWhere(['like', 'ID_SPDOC', $this->ID_SPDOC])
            ->andFilterWhere(['like', 'NAME', $this->NAME])
            ->andFilterWhere(['like', 'PRICE', $this->PRICE]);

        return $dataProvider;
}
}