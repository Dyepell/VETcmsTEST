<?php


namespace app\controllers;

use app\models\PacientForm;
use app\models\User;
use MyUtility\MyUtility;
use Yii;
use app\models\DocTemplateForm;
use app\models\IstbolForm;
use TextFiller\TextFiller;
use yii\base\BaseObject;
use yii\data\ActiveDataProvider;

class DocsController extends AppController
{
		//Массив связей (не все связи в моделях настроены), тип шаблона => модель, к которой идет обращение
		private $relations = [
				'istBol' => [
						'tableName' => '\app\models\IstbolForm',
						'idCol']
		];

		public $layout='basic';

		public function beforeAction($action)
		{
				if ($action->id=='index'){
						$this->enableCsrfValidation=false;
				}

            $session = Yii::$app->session;

            if ($session->get('authToken') === NULL) {
                $this->redirect("index.php?r=auth/login");
            } else if (User::findByToken($session->get('authToken')) == NULL) {
                $this->redirect("index.php?r=auth/logout");
            }
				return parent::beforeAction($action);
		}

		public function actionPrintdoc()
		{

				$data = [
						'templateType' => 'docx',
						'id' => $_GET['id']
				];
				$textFiller = new TextFiller($_GET['template'], $data);
				$textFiller->replace();
				header("Location: ".$_SERVER['HTTP_REFERER']);
		}

		public function actionTemplatepage() {
				$docsTemplates = new ActiveDataProvider([
						'query' => DocTemplateForm::find(),
						'pagination' => [
								'pageSize' => 10,

						],
				]);

				return $this->render('templatepage', compact('docsTemplates'));
		}

		public function actionDoctemplateform() {

		    if (!$_GET['docTemplateId']) {
		        $docTemplate = new DocTemplateForm();
		    } else {
		        $docTemplate = DocTemplateForm::find()->joinWith('docTemplateType')->where(['docTemplateId' => $_GET['docTemplateId']])->one();
		        if (($docTemplate->docTemplateType[0]->templateTypeName == 'docUslugi') OR ($docTemplate->docTemplateType[0]->templateTypeName == 'docRefuse')
                    OR ($docTemplate->docTemplateType[0]->templateTypeName == 'docSedation') OR ($docTemplate->docTemplateType[0]->templateTypeName == 'docInter')
                    OR ($docTemplate->docTemplateType[0]->templateTypeName == 'docHospital') OR ($docTemplate->docTemplateType[0]->templateTypeName == 'docCritical')
                    OR ($docTemplate->docTemplateType[0]->templateTypeName == 'docDolg')) {
                    $model = PacientForm::find()->orderBy('ID_PAC DESC')->one();
		            $id = $model->ID_PAC;
                } elseif ($docTemplate->docTemplateType[0]->templateTypeName == 'istBol') {
                    $model = IstbolForm::find()->orderBy('ID_IST DESC')->one();
		            $id = $model->ID_IST;
                } else {
                    throw new \Exception('Неизвестный шаблон');
		                exit();
                }

		        $data = [
		            'templateType' => 'docx',
                    'id' => $id
                ];
		        $textFiller = new TextFiller($docTemplate->docTemplateType[0]->templateTypeName, $data);

				}

				if ($docTemplate->load(Yii::$app->request->post())) {
						if ($docTemplate->Upload()) {
								$this->redirect("index.php?r=docs%2Ftemplatepage");
						}
				}
				return $this->render('doctemplateform', compact('docTemplate', 'textFiller'));
		}

        public function actionTemplatedownload() {
            $file = Yii::getAlias('@commonFolders/DocTemplates/') . $_GET['path'];

            if (file_exists($file)) {
                \Yii::$app->response->sendFile($file, 'docxdoc');
            }
        }

		public function actionDoctemplateformdelete() {
				$DocTemplateForm = DocTemplateForm::findOne(['docTemplateId'=>$_GET['docTemplateId']]);
				$DocTemplateForm->DeleteFile();
				$this->redirect("index.php?r=docs%2Ftemplatepage");
		}
}
