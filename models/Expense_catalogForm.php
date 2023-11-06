<?php


namespace app\models;
use yii\db\ActiveRecord;


class Expense_catalogForm extends ActiveRecord
{
    public  static function tableName()
    {
        return 'expense_catalog';
    }
    public  function attributeLabels()
    {
        return [
            'ID_EX'=>'ID расходника',
            'ID_PR' => 'Расходник',
            'IZM' => 'Ед. измерения',
            'KOL' => 'Количество',
            'PRICE' => 'Цена',
            'SUMM'=> 'Сумма'

        ];
    }
    public function rules()
    {
        return [
            [['ID_PR', "IZM", "KOL", "PRICE"], 'required'],
            [["ID_EX", "SUMM"],'safe'],


        ];
    }


}