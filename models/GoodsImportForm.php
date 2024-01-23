<?php


namespace app\models;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use MyUtility\MyUtility;


class GoodsImportForm extends ActiveRecord
{
    public $csvFile;


    public  static function tableName() {
        return 'prihod_tovara';
    }


    public  function attributeLabels() {
        return [
            'sourceId'=> 'Источник',
            'csvFile' => 'CSV файл'
        ];
    }

    public function attributes()
    {
        return array_merge(
            parent::attributes(),
            ['sourceId']
        );
    }


    public function rules() {
        return [
            [['csvFile'], 'file', 'skipOnEmpty' => true,'extensions' => 'csv'],
            [['sourceId'], 'safe']
        ];
    }


    public function Upload() {
        if($this->validate()){
            if (UploadedFile::getInstance($this, 'image') != null) {
                unlink(__DIR__ . "/../web/images/Brand images/".$this->getOldAttribute('imagePath'));
                $this->image = UploadedFile::getInstance($this, 'image');
                $this->imagePath = MyUtility::UniqidReal() . '.' . $this->image->extension;
                $this->setAttribute('imagePath', $this->imagePath);
                $this->image->saveAs(__DIR__ . "/../web/images/Brand images/" . $this->imagePath);
            }
            $this->save(false);
            return true;
        }else{
            return false;
        }
    }


    public function Import() {

        if($this->validate()) {
            file_put_contents(__DIR__ . "/../logs/csvLog.txt", 'test');
            return true;

        }
    }


    public function DeleteImage() {
        unlink(__DIR__ . "/../web/images/Brand images/".$this->getAttribute('imagePath'));
        $this->delete();
        return true;
    }

}