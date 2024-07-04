<?php


namespace app\models;


use yii\db\ActiveRecord;

class TovarForm extends ActiveRecord
{
    public  static function tableName()
    {
        return 'kattov';
    }
    public  function attributeLabels()
    {
        return [
            'ID_TOV'=>'ID',
            'NAME'=>'Наименование',
            'KOL'=>'Количество',
        ];
    }
    public function rules()
    {
        return [

            [["ID_TOV", "NAME", "KOL"], 'safe'],


        ];
    }

}