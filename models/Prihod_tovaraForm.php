<?php


namespace app\models;


use yii\db\ActiveRecord;

class Prihod_tovaraForm extends ActiveRecord
{
    private $cvsData = null;


    public  static function tableName()
    {
        return 'prihod_tovara';
    }


    public  function attributeLabels()
    {
        return [
            'ID_PRIHOD'=>'ID поступления',
            'ID_TOV'=>'Товар',
            'EXPIRATION_DATE'=>'Срок годности',
            'SUMM'=>'Сумма',
            'DATE'=>'Дата',
            'KOL'=>'Количество',
            'SELL_PRICE'=>'Цена продажи',
            'PRICE'=>'Цена',
            'PRIM'=>'Примечание'
        ];
    }


    public function rules()
    {
        return [
            [["ID_PRIHOD", "ID_TOV", "KOL", "SUMM", "DATE", 'PRICE', 'SELL_PRICE', "EXPIRATION_DATE", "PRIM"], 'safe'],
        ];
    }


    public function ImportSbis() {


        return true;
    }

}