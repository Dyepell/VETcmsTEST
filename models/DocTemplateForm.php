<?php


namespace app\models;
use MyUtility\MyUtility;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;


class DocTemplateForm extends ActiveRecord
{
		public $file;
		private $filePath;

		public  static function tableName()
		{
				return 'docTemplate';
		}

		public  function attributeLabels()
		{
				return [
						'docTemplateId' => 'ID шаблона',
						'docTemplateTypeId' => 'Тип шаблона',
						'templateName' => 'Наименование шаблона',
						'isDefault' => 'Использовать по умолчанию',
						'filePath' => 'Путь к файлу',
						'file' => 'File'
				];
		}

		public function rules()
		{
				return [
						[['file'], 'file', 'skipOnEmpty' => true,'extensions' => 'docx, html, txt'],
						[['docTemplateId', 'docTemplateTypeId', 'templateName', 'isDefault'], 'safe']
				];
		}

		public function getDocTemplateType(){
				return $this->hasMany(DocTemplateTypeForm::className(), ['docTemplateTypeId' => 'docTemplateTypeId']);
		}

		public function Upload() {
				if($this->validate()){
						if (UploadedFile::getInstance($this, 'file') != null) {
								unlink(__DIR__ . "/../DocTemplates/".$this->getOldAttribute('imagePath'));
								$this->file = UploadedFile::getInstance($this, 'file');
								$this->filePath = MyUtility::UniqidReal() . '.' . $this->file->extension;
								$this->setAttribute('filePath', $this->filePath);
								$this->file->saveAs(__DIR__ . "/../DocTemplates/" . $this->filePath);
						}
						$this->save(false);
						return true;
				}else{
						return false;
				}
		}

		public function DeleteFile() {
				unlink(__DIR__ . "/../DocTemplates/".$this->getAttribute('filePath'));
				$this->delete();
				return true;
		}


}