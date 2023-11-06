<?php


namespace app\models;
use yii\db\ActiveRecord;


class FacilityForm extends ActiveRecord
{
    public  static function tableName()
    {
        return 'facility';
    }
    public  function attributeLabels()
    {
        return [
            'ID_PAC'=>'ID пациента',
            'ID_DOC' => 'Специалист',
            'ID_PR' => 'Услуга',
            'KOL' => 'Количество',
            'DATA' => 'Дата оказания',
            'DATASL'=> 'Дата следующего оказания (не обязательно)',
            "DISCOUNT_SUMM"=>"Сумма со скидкой",
            "DISCOUNT_PROCENT"=>"Процент скидки",

        ];
    }
    public function rules()
    {
        return [
            [['ID_PAC', "ID_DOC", "ID_PR", "KOL", "DATA"], 'required'],
            [["DATASL", "DISCOUNT_SUMM"], 'safe'],


        ];
    }


}