<?php


namespace app\models;
use yii\db\ActiveRecord;



class Client extends ActiveRecord
{
    public static function tableName()
    {
        return 'client';
    }

    public function getPacients(){
        return $this->hasMany(Pacient::className(), ['ID_CL' => 'ID_CL']);
    }
}