<?php


namespace app\models;
use yii\db\ActiveRecord;

class Sl_vakcForm extends ActiveRecord{
    public  static function tableName()
    {
        return 'sl_vakc';
    }

    public function rules()
    {
        return [

            [["ID_PAC", "DATA", "NAME", "DATASL"], 'safe'],


        ];
    }
}