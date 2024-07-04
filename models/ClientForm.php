<?php


namespace app\models;
use MyUtility\MyUtility;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;


class ClientForm extends ActiveRecord
{
    public $document;
    private $documentPath;

    public  static function tableName()
    {
        return 'client';
    }
    public  function attributeLabels()
    {
        return [
            'ID_CL'=>'ID клиента',
            'NAME' => 'Имя',
            'FAM' => 'Фамилия',
            'OTCH' => 'Отчество',
            'CITY' => 'Город',
            'STREET'=>'Улица',
            'HOUSE'=>'Дом',
            'CORPS'=>'Корп.',
            'FLAT'=>'Кв.',
            'PHONED'=>'Домашний телефон',
            'PHONES'=>'Сотовый телефон',
            'EMAIL'=>'Электронная почта',
            'FIRST_DATE_N' => 'Дата регистрации',
            'document' => 'Документ'
        ];
    }
    public function rules()
    {
        return [
          [['document'], 'file', 'skipOnEmpty' => true],
            [['ID_CL','NAME', 'FAM', 'OTCH', 'CITY', "STREET", "HOUSE", "CORPS", "FLAT",
                "PHONED", "PHONES", "EMAIL"], 'safe'],


        ];
    }

  public function Upload() {
    //перенести в ScannedDocForm

    if($this->validate()){
      if (UploadedFile::getInstance($this, 'document') != null) {
        $this->document = UploadedFile::getInstance($this, 'document');
        $this->documentPath = MyUtility::UniqidReal() . '.' . $this->document->extension;
        $this->document->saveAs(__DIR__ . "/../ScannedDocs/" . $this->documentPath);
        $scanDoc = new ScannedDocForm();
        $scanDoc->clientId = $this->ID_CL;
        $scanDoc->scanPath = $this->documentPath;
        $scanDoc->scanName = $this->document;
        $scanDoc->save();
      }
      $this->save(false);
      return true;
    }else{
      return false;
    }
  }


}