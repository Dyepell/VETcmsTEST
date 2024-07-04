<?php


namespace app\models;
use MyUtility\MyUtility;
use yii\db\ActiveRecord;


class PacientForm extends ActiveRecord
{
    public $docUslugi;
    public $docRefuse;
    public $docSedation;
    public $docInter;
    public $docHospital;
    public $docCritical;
    public $docDolg;

    public  static function tableName()
    {
        return 'pacient';
    }

    public  function attributeLabels()
    {
        return [
            'ID_PAC'=>'ID пациента',
            'KLICHKA'=>'Кличка',
            'NAMEPOR'=>'Наименование породы',
            'BDAY'=>'Дата рождения',
            'VOZR'=>'Возраст',
            'POL'=>'Пол',
            'PRIMECH'=>'Примечание',

        ];
    }

    public function getVid(){
        return $this->hasOne(Vid::className(), ['ID_VID' => 'ID_VID']);
    }
    public function getPoroda(){
        return $this->hasOne(Poroda::className(), ['ID_POR' => 'ID_POR']);
    }
    public function getDoctor(){
        return $this->hasOne(Doctor::className(), ['ID_DOC' => 'ID_LDOC']);
    }

		public function getClient(){
				return $this->hasOne(Client::className(), ['ID_CL' => 'ID_CL']);
		}

		public function dataForTags($templateType){
            $temp[] = '_______';

            if (($templateType == 'docUslugi') OR ($templateType == 'docRefuse') OR ($templateType == 'docSedation') OR ($templateType == 'docInter')
                OR ($templateType == 'docHospital') OR ($templateType == 'docCritical') OR ($templateType == 'docDolg')) {
                //пока применяются только ранее используемые в документах поля, позднее, с настройкой связей можно будет выводить все возможные поля
                $data['data'] = array_merge(
                    ($this->getClient()->one() != NULL) ? $this->getClient()->one()->getAttributes() : $temp,
                    ($this->getVid()->one() != NULL) ? $this->getVid()->one()->getAttributes() : $temp,
                    $this->getAttributes()
                ) ;

                //переделать через self без экземпляров моделей
                $attrNames = array_merge(
                    ($this->getClient()->one() != NULL) ? $this->getClient()->one()->attributeLabels() : $temp,
                    ($this->getVid()->one() != NULL) ? $this->getVid()->one()->attributeLabels() : $temp,
                    $this->attributeLabels()
                );

                $data['attrNames'] = array_intersect_key($attrNames, $data['data']);
            } else {
                throw new \Exception('Неизвестный шаблон');
                exit();
            }


				return $data;
		}
    
    
    public function rules()
    {
        return [
            [['ID_PAC', "KLICHKA", "NAMEPOR", "VOZR", "POL", "PRIMECH", "ID_CL", "ID_LDOC", "ID_POR", "BDAY", "ID_VID"], 'safe'],



        ];
    }


}