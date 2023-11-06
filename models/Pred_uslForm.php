<?php


namespace app\models;


use yii\db\ActiveRecord;

class Pred_uslForm extends ActiveRecord
{
    public  static function tableName()
    {
        return 'pred_usl';
    }
    public  function attributeLabels()
    {
        return [
            'ID_PRED'=>'ID ',
            'ID_PR'=>'Процедура',
            'ID_PAC'=>'Пациент',
            'FIRST_DATE'=>'Дата предыдущей',
            'SECOND_DATE'=>'Дата следующей',



        ];
    }
    public function rules()
    {
        return [

            [["ID_PRED", "ID_PR", "FIRST_DATE", "SECOND_DATE"], 'safe'],


        ];
    }

}