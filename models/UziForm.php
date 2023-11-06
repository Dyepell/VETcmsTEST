<?php


namespace app\models;
use yii\db\ActiveRecord;


class UziForm extends ActiveRecord
{
    public  static function tableName()
    {
        return 'uzi';
    }
    public  function attributeLabels()
    {
        return [
            'ID_BIOHIM'=>'ID анализа',
            'ID_PAC'=>'ID пациента',
            'DATE'=>'Дата',
            'OP'=>'Заключение',



        ];
    }
    public function rules()
    {
        return [
            [["ID_BIOHIM", "ID_PAC", "DATE", "OP"], 'safe'],


        ];
    }
}