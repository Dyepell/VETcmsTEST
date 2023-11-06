<?php


namespace app\models;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;



class Prihod_tovara extends ActiveRecord
{
    public static function tableName()
    {
        return 'prihod_tovara';
    }
    public function getTovar(){
        return $this->hasOne(Kattov::className(), ['ID_TOV' => 'ID_TOV']);
    }

}