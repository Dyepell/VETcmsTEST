<?php


namespace app\models;


use yii\db\ActiveRecord;

class PriceForm extends ActiveRecord
{
    public  static function tableName()
    {
        return 'price';
    }
    public  function attributeLabels()
    {
        return [
            'ID_PR'=>'ID ',
            'DATA'=>'Дата',
            'PRICE'=>'Цена',
            'ID_SPDOC'=>'Вид',
            'NAME'=>'Наименование',
            'IsCount'=>'Подсчет',
            'KOL'=>'Количество',
            'IZM'=>"Ед. измерения"


        ];
    }
    public function rules()
    {
        return [
            [["ID_PR"], 'safe'],
            [["DATA", "PRICE", "ID_SPDOC", "NAME", "IsCount", "KOL", "IZM"], 'safe'],


        ];
    }

}