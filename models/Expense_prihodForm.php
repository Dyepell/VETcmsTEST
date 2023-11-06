<?php


namespace app\models;
use yii\db\ActiveRecord;


class Expense_prihodForm extends ActiveRecord
{
    public  static function tableName()
    {
        return 'expense_prihod';
    }
    public  function attributeLabels()
    {
        return [
            'ID_EXPR'=>'ID прихода',
            'ID_PR' => 'Расходник',
            'PRICE' => 'Цена',
            'KOL' => 'Количество',
            'PRICE' => 'Цена',

        ];
    }
    public function rules()
    {
        return [
            [['ID_PR', "PRICE", "KOL"], 'safe'],
            [["ID_EXPR"],'safe'],


        ];
    }


}