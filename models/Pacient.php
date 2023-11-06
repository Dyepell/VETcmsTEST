<?php


namespace app\models;
use yii\db\ActiveRecord;



class Pacient extends ActiveRecord
{
    public static function tableName()
    {
        return 'pacient';
    }
    public function getVid(){
        return $this->hasOne(Vid::className(), ['ID_VID' => 'ID_VID']);
    }
    public function getPoroda(){
        return $this->hasOne(Poroda::className(), ['ID_POR' => 'ID_POR']);
    }
    public function getDoctor(){
        return $this->hasOne(Doctor::className(), ['ID_LDOC' => 'ID_DOC']);
    }

}