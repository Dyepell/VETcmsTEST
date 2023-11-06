<?php


namespace app\models;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;



class Kattov extends ActiveRecord
{
    public static function tableName()
    {
        return 'kattov';
    }


}