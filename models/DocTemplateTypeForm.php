<?php


namespace app\models;
use yii\db\ActiveRecord;


class DocTemplateTypeForm extends ActiveRecord
{
		public  static function tableName()
		{
				return 'docTemplateType';
		}

		public  function attributeLabels()
		{
				return [
						'docTemplateTypeId'=>'ID типа шаблона',
						'templateTypeName '=>'Наименование типа шаблона',
						'templatePseudoName'=>'Псевдоним шаблона'
				];
		}

		public function rules()
		{
				return [
						[['docTemplateTypeId', 'templateTypeName', 'templatePseudoName'], 'safe']
				];
		}


}