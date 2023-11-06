<?php


namespace app\models;
use yii\db\ActiveRecord;


class ClientForm extends ActiveRecord
{
    public  static function tableName()
    {
        return 'client';
    }
    public  function attributeLabels()
    {
        return [
            'ID_CL'=>'ID клиента',
            'NAME' => 'Имя',
            'FAM' => 'Фамилия',
            'OTCH' => 'Отчество',
            'CITY' => 'Город',
            'STREET'=>'Улица',
            'HOUSE'=>'Дом',
            'CORPS'=>'Корп.',
            'FLAT'=>'Кв.',
            'PHONED'=>'Домашний телефон',
            'PHONES'=>'Сотовый телефон',
            'EMAIL'=>'Электронная почта',
        ];
    }
    public function rules()
    {
        return [
            [['ID_CL','NAME', 'FAM', 'OTCH', 'CITY', "STREET", "HOUSE", "CORPS", "FLAT",
                "PHONED", "PHONES", "EMAIL"], 'safe'],


        ];
    }


}