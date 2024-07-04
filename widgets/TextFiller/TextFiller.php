<?php
namespace TextFiller;

//295 стр шаблоном Strategy


use app\models\DocTemplateForm;
use app\models\DocTemplateTypeForm;
use app\models\IstbolForm;
use app\models\PacientForm;
use execut\yii\base\Exception;
use MyUtility\MyUtility;
use yii\mutex\MysqlMutex;

class TextFiller
{
    const TAG = '$$';
    public $templateTypeName;
		public $templatePath;
		public $templatePseudoName;
		public $postfix;
    public $id;
    public $replacer;
    public $phrases;
    public $phrasesHint;
    public $buttonText;
    //Массив связей (не все связи в моделях настроены), тип шаблона => модель, к которой идет обращение
    private $relations = [
    	'istBol' => 'IstbolForm'
    ];

    public function __construct($templateTypeName, $data)
    {
				$this->id = $data['id'];
    		$docTemplate = DocTemplateForm::find()->joinWith('docTemplateType')->where(['templateTypeName' => $templateTypeName, 'isDefault' => 1])->one();
        $this->templatePath = $docTemplate->filePath;
        $this->templateTypeName = $templateTypeName;
        $this->templatePseudoName = $docTemplate->templateName;


        $this->prepareData($data);

        if ($data['templateType'] == 'docx' && file_exists(\Yii::$app->basePath."/DocTemplates/".$this->templatePath)) {
            $this->replacer = new DocxReplacer();
        } else {
            $this->replacer = new SimpleTextReplacer();
        }
    }

    private function prepareData($data)
    {
        //выделить эти ифы в метод
        if (($this->templateTypeName == 'docUslugi') OR ($this->templateTypeName == 'docRefuse') OR ($this->templateTypeName == 'docSedation')
            OR ($this->templateTypeName == 'docInter') OR ($this->templateTypeName == 'docHospital') OR ($this->templateTypeName == 'docCritical')
            OR ($this->templateTypeName == 'docDolg')){
            $model = PacientForm::findOne(['ID_PAC' => $data['id']]);
        } elseif ($this->templateTypeName == 'istBol') {
            $model = IstbolForm::findOne(['ID_IST' => $data['id']]);
        } else {
            throw new \Exception('Неизвестный шаблон');
            exit();
        }

        $model = $model->dataForTags($this->templateTypeName);
        $this->phrases = $model['data'];
        $this->postfix = $model['data']['KLICHKA'] . ' '.  $model['data']['FAM'] . ' ' . $model['data']['NAME'] . ' ' . $model['data']['OTCH'];
        $this->phrasesHint = $this->implodeTags($model['attrNames']);

    }

    public function replace(): bool
    {
        $this->replacer->replace($this);
        $this->output();
        return true;
    }

    public function renderButton($buttonText = 'На печать')
    {
        $this->buttonText = $buttonText;
        $this->replacer->renderButton($this);
    }

    public function implodeTags($input)
    {
        $data = [];
        foreach ($input as $key => $input) {
            $data[self::TAG.$key.self::TAG] = $input;
        }
        return $data;
    }

    private function output()
    {
        $this->replacer->output($this);
    }
}