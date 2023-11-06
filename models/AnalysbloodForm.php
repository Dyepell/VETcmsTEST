<?php


namespace app\models;
use yii\db\ActiveRecord;


class AnalysbloodForm extends ActiveRecord
{
    public  static function tableName()
    {
        return 'analys_blood';
    }
    public  function attributeLabels()
    {
        return [
            'ID_BLOOD'=>'ID анализа',
            'ID_PAC'=>'ID пациента',
            'DATE'=>'Дата',
            'ERIT'=>'Эритроциты',
            'GEMOG' => 'Гемоглобин',
            'COLOR' => 'Цвет. показатель',
            'LEIC' => 'Лейкоциты',
            'BAZ' => 'Базофилы',
            'EOZ' => 'Эозинофилы',
            'MIEL'=>'Н. миелоциты',
            'NUN'=>'Н. юные',
            'NPAL'=>'Н. палочкоядерные',
            'NSEG'=>'Н. сегментоядерные',
            'LIMF'=>'Лимфоциты',
            'MONO'=>'Моноциты',
            'PLAZM'=>'Плазм. клетки',
            'SOE'=>'СОЭ',
            'OSOTM'=>'Особые отметки',
            'GEMAT'=>'Гематокрит',
            'TROMBOCIT'=>'Тромбоциты',
            'TROMBOKRIT'=>'Тромбокрит',

        ];
    }
    public function rules()
    {
        return [
            [["ID_BLOOD", "ID_PAC", "ERIT", "GEMOG", "COLOR", "LEIC", "BAZ", "EOZ", "MIEL", "NUN", "NPAL",
                "NSEG", "LIMF", "MONO", "PLAZM", "SOE", "OSOTM", "GEMAT", "TROMBOCIT", "TROMBOKRIT", "DATE"], 'safe'],


        ];
    }
}