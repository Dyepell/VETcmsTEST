<?php
namespace app\controllers;

use app\models\BrandImagesForm;
use app\models\ClientForm;
use app\models\User;
use Yii;
use app\models\Clinic;
use app\models\ClinicForm;
use app\models\BrandImagesTypesForm;
use yii\data\ActiveDataProvider;
use MyUtility\MyUtility;
use app\models\Client;



class ClinicController extends AppController
{
    public $layout='basic';


    public function beforeAction($action) {
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
        return $this->render('brandimage', compact('brandImage'));
    }


    public function actionBrandimagedelete() {
        $brandImage = BrandImagesForm::findOne(['id'=>$_GET['id']]);
        $brandImage->DeleteImage();
        $this->redirect("index.php?r=clinic%2Fclinicpage");
    }


    public function actionClinicstats(){
        $year = ($_GET['year'] < 2011) ? date('Y') : $_GET['year'];

        $sql = "
            SELECT
              DATE_FORMAT(FIRST_DATE_N, '%c') AS month,
              COUNT(ID_CL) AS count
            FROM client
            WHERE 
            YEAR(FIRST_DATE_N) = $year
            GROUP BY
              MONTH(FIRST_DATE_N)
            ORDER BY month ASC;";

        $allClients = \Yii::$app->getDb()->createCommand($sql)->queryAll();

        $sql = "
            SELECT
              DATE_FORMAT(FIRST_DATE_N, '%c') AS month,
              COUNT(ID_CL) AS count
            FROM client
            WHERE EMAIL <> '' AND
            YEAR(FIRST_DATE_N) = $year 
            GROUP BY
              MONTH(FIRST_DATE_N)
            ORDER BY month ASC;";

        $hasEmail = \Yii::$app->getDb()->createCommand($sql)->queryAll();

        $data = [];
        for($i = 1; $i <= 12; $i++ ){
            $data[$i]['total'] = 0;
            $data[$i]['hasEmail'] = 0;
            $data[$i]['percent'] = 0;
        }

        foreach ($allClients as $m){
            $data[$m['month']]['total'] = $m['count'];
            $data[$m['month']]['hasEmail'] = 0;
            $data[$m['month']]['percent'] = 0;
        }

        foreach ($hasEmail as $m){
            $data[$m['month']]['hasEmail'] = $m['count'];
            if ($m['count'] > 0 ){
                $data[$m['month']]['percent'] =  round($m['count'] / $data[$m['month']]['total'] * 100 ,1);
            }
        }

        return $this->render('clinicstats', compact('data'));
    }

}