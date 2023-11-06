<?php


namespace app\models;
use yii\db\ActiveRecord;



class Facility extends ActiveRecord
{
    public static function tableName()
    {
        return 'facility';
    }

    public function getPacient(){
        return $this->hasOne(Pacient::className(), ['ID_PAC' => 'ID_PAC']);
    }


    public function getClient(){
        return $this->hasOne(Client::className(), ['ID_CL' => 'ID_CL']);
    }
    public function getPrice(){
        return $this->hasOne(Price::className(), ['ID_PR' => 'ID_PR']);
    }
    public function getDoctor(){
        return $this->hasOne(Doctor::className(), ['ID_DOC' => 'ID_DOC']);
    }

}