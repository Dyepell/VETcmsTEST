<?php


namespace app\models;
use yii\db\ActiveRecord;



class Write_off extends ActiveRecord
{
    public static function tableName()
    {
        return 'writeoff';
    }

    public function getPrihod(){
        return $this->hasOne(Diagnoz::className(), ['ID_PRIHOD' => 'ID_PRIHOD']);
    }


}