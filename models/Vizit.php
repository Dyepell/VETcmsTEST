<?php


namespace app\models;
use yii\db\ActiveRecord;



class Vizit extends ActiveRecord
{
    public static function tableName()
    {
                return 'vizit';
    }

    public function getDiagnoz(){
        return $this->hasOne(Diagnoz::className(), ['ID_D' => 'ID_DIAG']);
    }
    public function getOplata(){
        return $this->hasMany(Oplata::className(), ['ID_VIZIT' => 'ID_VISIT']);
    }

    public function getHiddenFormTokenField() {
        $token = \Yii::$app->getSecurity()->generateRandomString();
        $token = str_replace('+', '.', base64_encode($token));
    
        \Yii::$app->session->set(\Yii::$app->params['form_token_param'], $token);;
        return Html::hiddenInput(\Yii::$app->params['form_token_param'], $token);
    }
}