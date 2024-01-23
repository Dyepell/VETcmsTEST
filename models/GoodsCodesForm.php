<?php


namespace app\models;
use yii\db\ActiveRecord;



class GoodsCodesForm extends ActiveRecord
{
    public  static function tableName() {
        return 'goods_codes';
    }


    public  function attributeLabels() {
        return [
            'id' => 'ID кода товара',
            'sourceId' => 'ID источника',
            'goodId' => 'ID товара',
            'code' => 'Код товара'
        ];
    }


    public function rules() {
        return [
            [['id', 'sourceId', 'goodId', 'code'], 'safe']
        ];
    }


    public function getGood(){
        return $this->hasOne(Kattov::className(), ['goodId' => 'ID_TOV']);
    }
}