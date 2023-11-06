<?php


namespace app\models;
use yii\db\ActiveRecord;


class IstbolForm extends ActiveRecord
{
    public  static function tableName()
    {
        return 'istbol';
    }
    public  function attributeLabels()
    {
        return [
            'ID_IST'=>'ID истории',
            'ID_PAC' => 'ID пациента',
            'OBSL' => 'Данные объективного обследования',
            'VAK'=>"Вакцинация",
            "GLIST"=>"Обработка от глистов",
            "BLOH"=>"Обработка от блох и клещей",
            "BEGORE_SICK"=>"Ранее болели",
            "BEFORE_HEAL"=>"Ранее лечили",
            "ALLERGY"=>"Аллергии",
            "COMPLAINTS"=>"Что беспокоит",
            "START"=>"Начало возникновения симптомов",
            "BEFORE"=>"Что предшествовало",
            "ABOUT_HEAL"=>"Чем лечили",
            "STATE"=>"",
            "SLIZ_STATE"=>"",
            "SHERST_STATE"=>"",
            "UHO"=>"",
            "POLOST"=>"",
            "CHSS"=>"",
            "CHDD"=>"",
            "T"=>"",
            "UPIT"=>"",
            "SKIN_STATE"=>"",
            "LU_STATE"=>"",
            "ODA"=>"",
            "IGD"=>"",
            ];

    }
    public function rules()
    {
        return [
            [['ID_IST', "ID_PAC", "OBSL", "VAK", "GLIST", "BLOH", "BEFORE_SICK", "BEFORE_HEAL", "ALLERGY", "COMPLAINTS",
                "START", "BEFORE", "ABOUT_HEAL", "STATE", "SLIZ_STATE", "SHERST_STATE","UHO", "POLOST",
                "CHSS", "CHDD", "T", "UPIT", "SKIN_STATE", "LU_STATE", "ODA", "IGD"], 'safe'],


        ];
    }


}