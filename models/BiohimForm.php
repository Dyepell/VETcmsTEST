<?php


namespace app\models;
use yii\db\ActiveRecord;


class BiohimForm extends ActiveRecord
{
    public  static function tableName()
    {
        return 'biohim';
    }
    public  function attributeLabels()
    {
        return [
            'ID_BIOHIM'=>'ID анализа',
            'ID_PAC'=>'ID пациента',
            'DATE'=>'Дата',
            'BELOK'=>'Белок общий',
            'BILIRUB_OBSH' => 'Билирубин общий',
            'BILIRUB_PR' => 'Билирубин прямой',
            'BILIRUB_NEPR' => 'Билирубин непрямой',
            'AC_AT' => 'Ac-AT',
            'AL_AT' => 'Ал-АТ',
            'SUGAR'=>'Сахар',
            'MOCH'=>'Мочевина',
            'KREATIN'=>'Креатин',
            'LDG'=>'ЛДГ',
            'GAMMA_GTP'=>'Гамма ГТП',
            'AMILAZA'=>'Амилаза',
            'KALIY'=>'Калий',
            'KALCIY'=>'Кальций',
            'SHELOCH'=>'Щелочная фосфатаза',
            'HOL'=>'Холестерин',
            "ALB"=>"Альбумин",
            "P"=>"Р",
            "K"=>"К",


        ];
    }
    public function rules()
    {
        return [
            [["ID_BIOHIM", "ID_PAC", "DATE", "BELOK", "BILIRUB_OBSH", "BILIRUB_PR", "BILIRUB_NEPR", "AC_AT", "AL_AT", "SUGAR", "MOCH",
                "KREATIN", "LDG", "GAMMA_GTP", "AMILAZA", "KALIY", "KALCIY", "SHELOCH", "FOSFOR", "HOL","ALB", "P", "K"], 'safe'],


        ];
    }
}