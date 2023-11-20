<?php


namespace app\models;

use yii\db\ActiveRecord;

class SaleItemsForm extends ActiveRecord
{
    public  static function tableName()
    {
        return 'sale_items';
    }


    public  function attributeLabels()
    {
        return [
            'id' => 'ID элемента продажи',
            'saleId' => 'ID продажи',
            'ID_PRIHOD' => 'Товар',
            'qty' => 'Количество',
            'discount' => 'Скидка'
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
            [["id", "saleId", "ID_PRIHOD","qty", "discount"], 'safe'],
        ];
    }

}