<?php


namespace app\models;
use yii\db\ActiveRecord;


class Reception extends ActiveRecord
{
    public  static function tableName() {
        return 'reception';
    }


    public  function attributeLabels() {
        return [
            'receptionId' => 'ID приема',
            'date' => 'Дата',
            'startTime' => 'Время начала приема',
            'duration' => 'Продолжительность',
            'recetionType' => 'Тип приема',
            'clientId' => 'Клиент',
            'pacId' => 'Пациент'
        ];
    }


    public function getPacient(){
        return $this->hasOne(Pacient::className(), ['idPac' => 'ID_PAC']);
    }


    public function rules() {
        return [
            [['receeptionId', 'date', 'startTime', 'duration', 'doctors', 'receptionType', 'clientId', 'pacId'], 'safe']
        ];
    }
}