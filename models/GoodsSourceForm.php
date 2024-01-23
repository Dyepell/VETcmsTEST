<?php


namespace app\models;
use yii\db\ActiveRecord;


class GoodsSourceForm extends ActiveRecord
{
    public  static function tableName() {
        return 'goods_source';
    }


    public  function attributeLabels() {
        return [
            'id' => 'ID источника',
            'name' => 'Наименование источника',
            'codeFormat' => 'Формат кода товара'
        ];
    }


    public function rules() {
        return [
            [['id', 'name', 'codeFormat'], 'safe']
        ];
    }
}