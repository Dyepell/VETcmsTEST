<?php


namespace app\models;
use yii\db\ActiveRecord;


class WriteOffForm extends ActiveRecord
{
    public  static function tableName()
    {
        return 'writeoff';
    }
    public  function attributeLabels()
    {
        return [
            'Writeoff_ID'=>'ID списания',
            'ID_PRIHOD' => 'Товар',
            'SOTRUDNIK' => 'Сотрудник',
            'KOL' => 'Количество',
            'SUMM' => 'Сумма',
            'DATE' => 'Дата',


        ];
    }
    public function rules()
    {
        return [
            [["Writeoff_ID", "ID_PRIHOD","SOTRUDNIK", "KOL", "SUMM", "DATE"], 'safe'],

        ];
    }


}