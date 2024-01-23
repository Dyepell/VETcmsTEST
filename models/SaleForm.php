<?php


namespace app\models;

use yii\db\ActiveRecord;

class SaleForm extends ActiveRecord
{

    public function __construct($config = [])
    {

        parent::__construct($config);
    }

    public  static function tableName()
    {
        return 'sale';
    }


    public  function attributeLabels()
    {
        return [
            'ID_SALE' => 'ID продажи',
            'ID_PRIHOD' => 'Товар',
            'ID_VISIT' => 'ID визита, в котором была оформлена продажа',
            'SOTRUDNIK'=>'Сотрудник',
            'NAME'=>'Наименование товара',
            'KOL'=>'Количество',
            'SKIDKA'=>'Скидка %',
            'VID_OPL'=>'Вид оплаты',
            'DATE'=>'Дата',
            'SUMM'=>'Сумма'
        ];
    }


    public function getPrihod(){
        return $this->hasOne(Prihod_tovaraForm::className(), ['ID_PRIHOD' => 'ID_PRIHOD']);
    }


    public function getGood(){
        return $this->hasOne(KattovForm::className(), ['ID_TOV' => 'ID_TOV'])->via('prihod');
    }


    public function rules()
    {
        return [
            [["ID_SALE", "ID_PRIHOD", "ID_VISIT","SOTRUDNIK", "NAME", "KOL", "SKIDKA", "VID_OPL", "DATE", 'SUMM'], 'safe'],
        ];
    }

}