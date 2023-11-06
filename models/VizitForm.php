<?php


namespace app\models;
use yii\db\ActiveRecord;


class VizitForm extends ActiveRecord
{
    public  static function tableName()
    {
        return 'vizit';
    }
    public  function attributeLabels()
    {
        return [
            'ID_VISIT'=>'ID визита',
            'ID_PAC' => 'ID пациента',
            'ID_CL' => 'ID клиента',
            'DATA' => 'Дата',
            'DATE' => 'Дата',
            'ID_DOC' => 'Специалист',
            'VIDOPL' => 'Вид оплаты',
            'SUMMAO'=>'Сумма оплаты',
            'PRIMECH'=>'Анамнез и лечение',
            'ID_DIAG'=>'Диагноз основного заболевания',
            'IsDolg'=>'Оплата долга'

        ];
    }
    public function rules()
    {
        return [
            [["ID_VISIT", "ID_PAC", "ID_CL", "DATA", "DATE", "ID_DOC", "VIDOPL", "SUMMAO", "PRIMECH", "ID_DIAG", "IsDolg"], 'safe'],


        ];
    }
    public function getHiddenFormTokenField() {
        $token = \Yii::$app->getSecurity()->generateRandomString();
        $token = str_replace('+', '.', base64_encode($token));
    
        \Yii::$app->session->set(\Yii::$app->params['form_token_param'], $token);;
        return Html::hiddenInput(\Yii::$app->params['form_token_param'], $token);
    }


}