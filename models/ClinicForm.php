<?php


namespace app\models;
use yii\db\ActiveRecord;


class ClinicForm extends ActiveRecord
{
    public  static function tableName()
    {
        return 'clinic';
    }
    public  function attributeLabels()
    {
        return [
            'id'=>'ID клиники',
            'clinicName'=>'Наименование клиники',
            'entrepreneurName'=>'Наименование ИП',
            'entrepreneurINN'=>'ИНН',
            'address'=>'Адрес',
            'email'=>'E-mail',
        ];
    }
    public function rules()
    {
        return [
            [['id', 'clinicName', 'entrepreneurName', 'entrepreneurINN', 'address', "email"], 'safe']
        ];
    }


}