<?php


namespace app\models;
use yii\db\ActiveRecord;


class BrandImagesTypesForm extends ActiveRecord
{
    public  static function tableName()
    {
        return 'brand_images_types';
    }
    public  function attributeLabels()
    {
        return [
            'id'=>'ID типа',
            'typeName'=>'Наименование типа брендового изображения',
            'typeDescription'=>'Описание типа, места использования и т.п.'
        ];
    }
    public function rules()
    {
        return [
            [['id', 'typeName', 'typeDescription'], 'safe']
        ];
    }


}