<?php


namespace app\models;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;



class Sale extends ActiveRecord
{
    public static function tableName()
    {
        return 'sale';
    }


}