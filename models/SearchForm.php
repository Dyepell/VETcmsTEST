<?php


namespace app\models;
use yii\db\ActiveRecord;

class SearchForm extends ActiveRecord{
    public  static function tableName()
    {
        return 'client';
    }

    public  function attributeLabels()
    {
        return [
            'FAM' => 'Поиск',


        ];
    }
}