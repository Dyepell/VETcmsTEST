<?php


namespace app\models;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;



class Price extends ActiveRecord
{
    public static function tableName()
    {
        return 'price';
    }
    public function getSpdoc(){
        return $this->hasOne(Spdoc::className(), ['ID_SPDOC' => 'ID_SPDOC']);
    }

}