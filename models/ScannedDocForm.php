<?php


namespace app\models;
use yii\db\ActiveRecord;


class ScannedDocForm extends ActiveRecord
{

    public  static function tableName()
    {
        return 'scanned_docs';
    }
    public  function attributeLabels()
    {
        return [
          'scanId'=>'ID отсканированного документа',
          'scanName' => 'Наименование отсканированного документа',
          'scanPath' => 'Путь к документу',
          'clientId' => 'ID клиента',

        ];
    }
    public function rules()
    {
        return [
          [['scanId','scanName', 'scanPath', 'clientId'], 'safe'],
        ];
    }

		public function DeleteDoc() {

				unlink(\Yii::getAlias('@commonFolders/ScannedDocs/').$this->getAttribute('scanPath'));
				$this->delete();
				return true;
		}


}