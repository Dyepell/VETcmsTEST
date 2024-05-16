<?php


namespace app\models;
use MyUtility\MyUtility;
use yii\db\ActiveRecord;


class IstbolForm extends ActiveRecord
{
    public  static function tableName()
    {
        return 'istbol';
    }

    public  function attributeLabels()
    {
        return [
            'ID_IST'=>'ID истории',
            'ID_PAC' => 'ID пациента',
            'OBSL' => 'Данные объективного обследования',
            'VAK'=>"Вакцинация",
            "GLIST"=>"Обработка от глистов",
            "BLOH"=>"Обработка от блох и клещей",
            "BEGORE_SICK"=>"Ранее болели",
            "BEFORE_HEAL"=>"Ранее лечили",
            "ALLERGY"=>"Аллергии",
            "COMPLAINTS"=>"Что беспокоит",
            "START"=>"Начало возникновения симптомов",
            "BEFORE"=>"Что предшествовало",
            "ABOUT_HEAL"=>"Чем лечили",
            "STATE"=>"",
            "SLIZ_STATE"=>"",
            "SHERST_STATE"=>"",
            "UHO"=>"",
            "POLOST"=>"",
            "CHSS"=>"",
            "CHDD"=>"",
            "T"=>"",
            "UPIT"=>"",
            "SKIN_STATE"=>"",
            "LU_STATE"=>"",
            "ODA"=>"",
            "IGD"=>"",
            'DIST' => 'Дата создания истории'
            ];

    }
    public function rules()
    {
        return [
            [['ID_IST', "ID_PAC", "OBSL", "VAK", "GLIST", "BLOH", "BEFORE_SICK", "BEFORE_HEAL", "ALLERGY", "COMPLAINTS",
                "START", "BEFORE", "ABOUT_HEAL", "STATE", "SLIZ_STATE", "SHERST_STATE","UHO", "POLOST",
                "CHSS", "CHDD", "T", "UPIT", "SKIN_STATE", "LU_STATE", "ODA", "IGD"], 'safe'],


        ];
    }
    
    
    public function getPacient(){
        return $this->hasOne(Pacient::className(), ['ID_PAC' => 'ID_PAC']);
    }

    public function getVid(){
        return $this->hasOne(Vid::className(), ['ID_VID' => 'ID_VID'])->via('pacient');
    }

    public function getClient(){
        return $this->hasOne(Client::className(), ['ID_CL' => 'ID_CL'])->via('pacient');
    }

    public function dataForTags($templateTypeName){
        //пока применяются только ранее используемые в документах поля, позднее, с настройкой связей можно будет выводить все возможные поля
				$temp[] = '_______';
        $data['data'] = array_merge(
						($this->getPacient()->one() != NULL) ? $this->getPacient()->one()->getAttributes(['ID_PAC', 'KLICHKA', 'POL', 'VOZR']) : $temp,
						($this->getClient()->one() != NULL) ? $this->getClient()->one()->getAttributes(['ID_CL', 'FAM', 'NAME', 'OTCH', 'PHONES']) : $temp,
						($this->getVid()->one() != NULL) ? $this->getVid()->one()->getAttributes(['NAMEVID']) : $temp,
            $this->getAttributes(['ID_IST', 'DIST', 'OBSL'])
				) ;

        //переделать через self без экземпляров моделей
        $attrNames = array_merge(
						($this->getPacient()->one() != NULL) ? $this->getPacient()->one()->attributeLabels() : $temp,
						($this->getClient()->one() != NULL) ? $this->getClient()->one()->attributeLabels() : $temp,
						($this->getVid()->one() != NULL) ? $this->getVid()->one()->attributeLabels() : $temp,
						$this->attributeLabels()
				);

        $data['attrNames'] = array_intersect_key($attrNames, $data['data']);
        return $data;
    }


}