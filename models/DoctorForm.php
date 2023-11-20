<?php


namespace app\models;
use yii\db\ActiveRecord;


class DoctorForm extends ActiveRecord
{
    public  static function tableName()
    {
        return 'doctor';
    }
    public  function attributeLabels()
    {
        return [
            'ID_DOC'=>'ID специалиста',
            'NAME' => 'ФИО',
            'STATUS_R' => 'Статус',
            'OKLAD' => 'Оклад',
            'THERAPY'=>'Процент терапия',
            'SURGERY'=>'Процент хирургия',
            'UZI'=>'Процент УЗИ',
            'MED'=>'Процент медикаменты',
            'VAKC'=>'Процент вакцинация',
            'DEG'=>'Процент дегельминтизация',
            'ANALYZ'=>'Процент анализы',
            'KORM'=>'Процент корм',
            'PHONE'=>'Номер телефона',
            "CITY"=>"Город",
            "STREET"=>"Улица",
            "HOUSE"=>"Дом",
            "FLAT"=>"Кв.",
            "BDAY"=>"Дата рождения",


        ];
    }
    public function rules()
    {
        return [
            [['ID_DOC', "NAME", "STATUS_R", "OKLAD", "THERAPY",
                "SURGERY", "UZI", "MED", "VAKC", "DEG", "ANALYZ", "KORM",
                "PHONE","CITY", "STREET", "HOUSE", "FLAT", "BDAY"], 'safe'],

        ];
    }

}