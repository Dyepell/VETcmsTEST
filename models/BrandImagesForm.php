<?php


namespace app\models;
use MyUtility\MyUtility;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;


class BrandImagesForm extends ActiveRecord
{
    public $image;
    private $imagePath;


    public  static function tableName() {
        return 'brand_images';
    }


    public  function attributeLabels() {
        return [
            'id' => 'ID изображения',
            'clinicId' => 'ID клиники',
            'imageName' => 'Наименование изображения',
            'imageDescription' => 'Описание изображения',
            'imageType' => 'Тип изображения',
            'imagePath' => 'Путь к файлу',
            'image' => 'Image'
        ];
    }


    public function rules() {
        return [
            [['image'], 'file', 'skipOnEmpty' => true,'extensions' => 'png, jpg, ico'],
            [['id', 'clinicId', 'imageDescription', 'imageName', 'imageType'], 'safe']
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


    public function DeleteImage() {
        unlink(__DIR__ . "/../web/images/Brand images/".$this->getAttribute('imagePath'));
        $this->delete();
        return true;
    }

}