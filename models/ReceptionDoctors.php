<?php


namespace app\models;
use yii\db\ActiveRecord;


class ReceptionDoctors extends ActiveRecord
{
    public  static function tableName() {
        return 'reception_doctors';
    }


    public  function attributeLabels() {
        return [
            'receptionId' => 'ID приема',
            'doctorId' => 'ID специалиста',
        ];
    }


    public function getDoctor(){
        return $this->hasOne(Doctor::className(), ['doctorId' => 'ID_DOC']);
    }

    public function getReception(){
        return $this->hasOne(Reception::className(), ['receptionId' => 'receptionId']);
    }


    public function rules() {
        return [
            [['doctorId', 'receptionId'], 'safe']
        ];
    }
}