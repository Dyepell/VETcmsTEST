<?php


namespace app\models;
use yii\db\ActiveRecord;


class Other_islForm extends ActiveRecord
{
    public  static function tableName()
    {
        return 'OTHER_ISL';
    }
    public  function attributeLabels()
    {
        return [
            'ID_OTHER'=>'ID анализа',
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