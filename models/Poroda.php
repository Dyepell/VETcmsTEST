<?php


namespace app\models;
use yii\db\ActiveRecord;


class Poroda extends  ActiveRecord
{
    public static function tableName()
    {
        return 'poroda';
    }
}