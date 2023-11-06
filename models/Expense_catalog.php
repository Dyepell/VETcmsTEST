<?php


namespace app\models;


use yii\db\ActiveRecord;

class Expense_catalog extends ActiveRecord
{
    public static function tableName()
    {
        return 'expense_catalog';
    }
    public function getPrice(){
        return $this->hasOne(Price::className(), ['ID_PR' => 'ID_PR']);
    }
}