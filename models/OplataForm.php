<?php


namespace app\models;
use yii\db\ActiveRecord;


class OplataForm extends ActiveRecord
{
    public  static function tableName()
    {
        return 'oplata';
    }
    public  function attributeLabels()
    {
        return [
            'ID_OPL'=>'ID jgkfns',
            'ID_CL' => 'Клиент',
            'DATE'=>'Дата',
            'ID_VIZIT' => 'Визит',
            'VID_OPL' => 'Вид оплаты',
            'SUMM' => 'Сумма',
            'ID_PAC'=>'Пациент',
            'IsDolg'=>"Оплата долга",

        ];
    }
    public function rules()
    {
        return [
            [["ID_OPL", "ID_CL", "DATE", "ID_VIZIT", "VID_OPL", "SUMM", "IsDolg"], 'safe'],


        ];
    }


}