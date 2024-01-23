<?php


namespace app\models;
use yii\db\ActiveRecord;


class SaleChecksForm extends ActiveRecord
{
    public  static function tableName() {
        return 'sale_checks';
    }


    public  function attributeLabels() {
        return [
            'id' => 'ID чека',
            'saleId' => 'ID продажи',
            'visitId' => 'ID визита',
            'shiftNum' => 'Номер кассовой смены',
            'checkNum' => 'Номер закрытого чека',
            'fiscalDocNum' => 'Номер фискального документа',
            'fiscalSign' => 'Фискальный признак',
            'date' => 'Дата формирования чека'
        ];
    }


    public function getTovar(){
        return $this->hasOne(Kattov::className(), ['ID_TOV' => 'ID_TOV']);
    }

    public function rules() {
        return [
            [['id', 'saleId', 'visitId', 'shiftNum', 'checkNum', 'fiscalDocNum', 'fiscalSign', 'date'], 'safe']
        ];
    }
}