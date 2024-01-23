<?php


namespace app\models;
use yii\db\ActiveRecord;



class GoodBarcodesForm extends ActiveRecord
{
    public  static function tableName() {
        return 'goods_barcodes';
    }


    public  function attributeLabels() {
        return [
            'id' => 'ID штрих-кода товара',
            'goodId' => 'ID товара',
            'barcode' => 'Штрих-код',
            'barcodeFormat' => 'Формат штрих-кода'
        ];
    }


    public function rules() {
        return [
            [['id', 'goodId', 'barcode', 'barcodeFormat'], 'safe']
        ];
    }


    public function getGood(){
        return $this->hasOne(Kattov::className(), ['goodId' => 'ID_TOV']);
    }
}