<?php


namespace app\models;

use yii\db\ActiveRecord;

class SaleForm_new extends ActiveRecord
{
    public $goodsReciepts = [];
    public $saleItems = [
        0 => []
    ];
    public $goodsBarcodes = ''; //json

    public function __construct($config = [])
    {
        $queryResult=Prihod_tovara::find()->joinWith('tovar')->orderBy([
            'NAME'=>SORT_ASC,
            'KOL'=>SORT_DESC,
        ])->all();

        foreach ($queryResult as $item){
            $this->goodsReciepts[$item->ID_TOV][name]=$item->tovar->NAME;
            $this->goodsReciepts[$item->ID_TOV][prihods][$item->ID_PRIHOD]=[
                'ID_PRIHOD'=>$item->ID_PRIHOD,
                'sellPrice'=>$item->SELL_PRICE,
                'kol'=>$item->KOL,
                'prim'=>$item->PRIM,
                'date'=>$item->DATE,
            ];
        }

        $this->goodsBarcodes = json_encode(GoodBarcodesForm::find()->select(['goodId', 'barcode'])->asArray()->all());

        parent::__construct($config);
    }

    public  static function tableName()
    {
        return 'sale_new';
    }


    public  function attributeLabels()
    {
        return [
            'id' => 'ID продажи',
            'visitId' => 'ID визита, к которому привязана продажа',
            'employeeId' => 'Сотрудник',
            'payType' => 'Тип оплаты'
        ];
    }


    public function rules()
    {
        return [
            [['id', 'visitId', 'employeeId', 'payType'], 'safe']
        ];
    }


    public function getPayType(){
        return $this->hasOne(SaleItemsForm::className(), ['payType' => 'id']);
    }


    public function getSaleItems(){
        return $this->hasMany(SaleItemsForm::className(), ['id' => 'saleId']);
    }
}