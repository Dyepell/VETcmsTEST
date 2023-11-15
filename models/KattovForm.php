<?php


namespace app\models;


use yii\db\ActiveRecord;

class KattovForm extends ActiveRecord
{
    public  static function tableName()
    {
        return 'kattov';
    }


    public  function attributeLabels()
    {
        return [
            'ID_TOV' => 'ID ',
            'NAME' => 'Наименование',
            'country' => 'Страна производитель',
            'description' => 'Описание товара'
        ];
    }


    public function rules()
    {
        return [

            [["ID_TOV", "NAME", 'country', 'description'], 'safe'],


        ];
    }
}