<?php


namespace app\models;
use yii\db\ActiveRecord;



class Doctor extends ActiveRecord
{
    public static function tableName()
    {
        return 'doctor';
    }


}