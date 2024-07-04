<?php


namespace app\models;
use yii\db\ActiveRecord;


class Vid extends  ActiveRecord
{
    public static function tableName()
    {
        return 'vid';
    }

    public  function attributeLabels()
    {
        return [
            'ID_VID'=>'ID вида',
            'NAMEVID' => 'Наименование вида',

        ];

    }
    public function rules()
    {
        return [
            [['ID_VID', "NAMEVID"], 'safe'],
        ];
    }
}