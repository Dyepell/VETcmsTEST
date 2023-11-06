<?php


namespace app\models;


use yii\db\ActiveRecord;

class Prihod_tovaraForm extends ActiveRecord
{
    public  static function tableName()
    {
        return 'prihod_tovara';
    }
    public  function attributeLabels()
    {
        return [
            'ID_PRIHOD'=>'ID ',
            'ID_TOV'=>'Товар',
            'PRICE'=>'Цена',
            'SUMM'=>'Суммы',
            'DATE'=>'Дата',
            'KOL'=>'Количество',
            'SELL_PRICE'=>'Цена продажи',
            'EXPIRATION_DATE'=>'Срок годности',
            'PRIM'=>'Примечание',


        ];
    }
    public function rules()
    {
        return [
            [["ID_PRIHOD", "ID_TOV", "KOL", "SUMM", "DATE", 'PRICE', 'SELL_PRICE', "EXPIRATION_DATE", "PRIM"], 'safe'],



        ];
    }

}