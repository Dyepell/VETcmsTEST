<?php


namespace app\models;


use yii\db\ActiveRecord;

class PayTypesForm extends ActiveRecord
{
    public  static function tableName()
    {
        return 'pay_types';
    }


    public  function attributeLabels()
    {
        return [
            'id' => 'ID типа',
            'name' => 'Тип оплаты'
        ];
    }


    public function rules()
    {
        return [
            [["id", "name"], 'safe'],
        ];
    }


}