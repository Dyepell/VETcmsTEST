<?php
namespace app\controllers;

use app\models\BrandImagesForm;
use Yii;
use app\models\Clinic;
use app\models\ClinicForm;
use app\models\BrandImagesTypesForm;
use yii\data\ActiveDataProvider;


class ClinicController extends AppController
{
    public $layout='basic';


    public function beforeAction($action) {
        if ($action->id=='index'){
            $this->enableCsrfValidation=false;
        }
        return parent::beforeAction($action);
    }


    public function actionClinicpage() {
        $clinic = ClinicForm::findOne(['id'=>1]);
        $brandImages = new ActiveDataProvider([
            'query' => BrandImagesForm::find(),
            'pagination' => [
                'pageSize' => 10,

            ],
        ]);

        if ( $clinic->load(Yii::$app->request->post()) ){
            if ($clinic->save()){
                return $this->redirect("index.php?r=clinic%2Fclinicpage");
            }
        }

        return $this->render('clinicpage', compact('clinic', 'brandImages'));
    }


    public function actionBrandimage() {
        $brandImagesTypes = BrandImagesTypesForm::find()->select(['typeName'])->column();

        if (!$_GET['id']) {
            $brandImage = new BrandImagesForm();
        } else {
            $brandImage = BrandImagesForm::findOne(['id'=>$_GET['id']]);
        }

        if ($brandImage->load(Yii::$app->request->post())) {
            if ($brandImage->Upload()) {
                $this->redirect("index.php?r=clinic%2Fclinicpage");
            }
        }
        return $this->render('brandimage', compact('brandImage', 'brandImagesTypes'));
    }


    public function actionBrandimagedelete() {
        $brandImage = BrandImagesForm::findOne(['id'=>$_GET['id']]);
        $brandImage->DeleteImage();
        $this->redirect("index.php?r=clinic%2Fclinicpage");
    }

}