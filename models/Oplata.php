<?php


namespace app\models;
use yii\db\ActiveRecord;



class Oplata extends ActiveRecord
{
    public static function tableName()
    {
        return 'oplata';
    }

    public function getClient(){
        return $this->hasOne(Client::className(), ['ID_CL' => 'ID_CL']);
    }
    public function getVisit(){
        return $this->hasOne(Vizit::className(), ['ID_VISIT' => 'ID_VIZIT']);
    }
    public function getPacient(){
        return $this->hasOne(Pacient::className(), ["ID_PAC"=>"ID_PAC"])->via("visit");
    }


}