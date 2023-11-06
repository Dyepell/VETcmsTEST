<?php


namespace app\models;
use yii\db\ActiveRecord;


class Vid extends  ActiveRecord
{
    public static function tableName()
    {
        return 'vid';
    }
}