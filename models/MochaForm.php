<?php


namespace app\models;
use yii\db\ActiveRecord;


class MochaForm extends ActiveRecord
{
    public  static function tableName()
    {
        return 'mocha';
    }
    public  function attributeLabels()
    {
        return [
            'ID_MOCHA'=>'ID анализа',
            'ID_PAC'=>'ID пациента',
            'DATE'=>'Дата',
            'KOL'=>'Кол-во, цвет, запах и др.',
            'BELOK' => 'Белок',
            'SUGAR' => 'Сахар',
            'ACETONE' => 'Ацетон',
            'UROB' => 'Уробилин',
            'REACT' => 'Реакция',
            'LEIC'=>'Лейкоциты',
            'ERIT'=>'Эритроциты',
            'CIL_GAL'=>'Цилиндроиды гиалиновые',
            'CIL_ZERN'=>'Цилиндроиды зернистые',
            'CIL_VOSK'=>'Цилиндроиды восковые',
            'CILINDROID'=>'Цилиндроиды',
            'EPIT'=>'Эпителий',
            'EPIT_POCH'=>'Эпителий почечный',
            'EPIT_PLOSK'=>'Щелочная плоский',
            'SLIZ'=>'Слизь',
            'SULT'=>'Соли',
            'BAKT'=>'Бактерии фосфатаза',


        ];
    }
    public function rules()
    {
        return [
            [["ID_MOCHA", "ID_PAC", "DATE", "KOL", "BELOK", "SUGAR", "ACETONE", "UROB", "REACT", "LEIC", "ERIT",
                "CIL_GAL", "CIL_ZERN", "CIL_VOSK", "CILINDROID", "EPIT", "EPIT_POCH", "EPIT_PLOSK", "SLIZ", "SULT", "BAKT"], 'safe'],


        ];
    }
}