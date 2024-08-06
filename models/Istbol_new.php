<?php


namespace app\models;
use yii\db\ActiveRecord;


class Istbol_new extends  ActiveRecord
{
    public static function tableName()
    {
        return 'istbol_new';
    }

    public  function attributeLabels()
    {
        return [
            'idIst'=>'ID истории',
            'ID_PAC' => 'ID пациента',
            'parentIst' => 'Первичная запись',
            'date' => 'Дата создания',

            'complaints' => 'Текущие жалобы',
            'howGet' => 'Как завели питомца',
            'petCare' => 'Содержание и кормление',
            'castration' => 'Кастрация',
            'deworming' => 'Дегельминтизация и обработка от внешних паразитов',
            'otherPets' => 'Наличие других питомцев',
            'chronic' => 'Хронические заболевания',
            'past' => 'Перенесенные заболевания и операции',
            'longTern' => 'Длительно применяемые препараты',
            'appetite' => 'Аппетит',
            'thirst' => 'Жажда',
            'poop' => 'Стул',
            'diurese' => 'Диурез',

            'status' => 'Общее состояние',
            'temperature' => 'Температура',
            'weight' => 'Вес',
            'fatness' => 'Упитанность',
            'membranes' => 'Слизистые оболочки',
            'oralCavity' => 'Ротовая полость',
            'heart' => 'Сердце',
            'breath' => 'Дыхание',
            'abdomen' => 'Брюшная полость',
            'leather' => 'Кожа и шерсть',
            'lymph' => 'Лимфатические узлы',
            'genitals' => 'Половые органы',
            'mammary' => 'Состояние молочных желез',
            'dehydration' => 'Дегидратация',
            'mental' => 'Ментальный статус',
            'pathological' => 'Данные обследования патологического очага',

            //TODO: уточнить про ВЕДУЩИЕ СИМПТОМЫ И ПРОБЛЕМЫ ПАЦИЕНТА

            'preDiagnos' => 'Предварительный диагноз',
            'diffDiagnos' => 'Дифференциальные диагнозы',
            'exDiagnos' => 'Исключенные диагнозы',
            'conPathology' => 'Сопутствующие патологии',
            'finalDiagnos' => 'Окончательный диагноз',

            'perfDiagnostics' => 'Проведенная диагностика',
            'recDiagnostics' => 'Рекомендованная диагностика',

            'addSurveys' => 'Данные дополнительных обследований',
            'perfManipulations' => 'Манипуляции, проведенная терапия на приеме',

						'recForOwner' => 'Рекомендации владельцу по дальнейшему лечению/профилактике',
            'commentsForDoc' => 'Комментарии для врачей последующих приемов',
        ];

    }
    public function rules()
    {
        return [
            [['idIst', "ID_PAC", 'complaints', 'parentIst', 'date', 'howGet', 'petCare',
								'castration', 'deworming', 'otherPets', 'chronic', 'past', 'longTern',
								'appetite', 'thirst', 'poop', 'diurese', 'status', 'temperature', 'weight',
								'fatness', 'membranes', 'oralCavity', 'heart', 'breath', 'abdomen',
								'leather', 'lymph', 'genitals', 'mammary', 'dehydration', 'mental', 'pathological',
								'preDiagnos', 'diffDiagnos', 'exDiagnos', 'conPathology', 'finalDiagnos', 'perfDiagnostics',
								'recDiagnostics', 'addSurveys', 'perfManipulations', 'recForOwner', 'commentsForDoc'], 'safe'],
        ];
    }
}