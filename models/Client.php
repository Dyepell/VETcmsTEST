<?php


namespace app\models;
use yii\db\ActiveRecord;



class Client extends ActiveRecord
{
    public static function tableName()
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
            'FIRST_DATE_N' => 'Дата регистрации',
            'document' => 'Документ'
        ];
    }

    public function getPacients(){
        return $this->hasMany(Pacient::className(), ['ID_CL' => 'ID_CL']);
    }


}