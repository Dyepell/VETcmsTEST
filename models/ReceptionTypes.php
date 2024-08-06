<?php


namespace app\models;
use yii\db\ActiveRecord;


class ReceptionTypes extends ActiveRecord
{
    public  static function tableName() {
        return 'reception_types';
    }


    public  function attributeLabels() {
        return [
            'receptionTypeId' => 'ID типа приема',
            'receptionTypeName' => 'Наименование типа приема',
            'color' => 'Цвет для выделения'
        ];
    }


    public function rules() {
        return [
            [['receptionTypeId', 'receptionTypeName', 'color'], 'safe']
        ];
    }
}