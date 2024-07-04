<?php
namespace app\controllers;
use app\models\ClinicForm;
use app\models\User;
use MercuryAPI\MercuryWrapper;

class CashboxController extends AppController
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


    public function actionCashboxpage() {
        $clinic = ClinicForm::findOne(['id'=>1]);
        $cashboxResponse['code'] = 'none';
        $mercuryWrapper = new MercuryWrapper('http://localhost:50010/api.json',
            $clinic->address, $clinic->clinicName, $clinic->email, $clinic->entrepreneurName, $clinic->entrepreneurINN);
        $commands = ['GetDriverInfo', 'CreateCheck', 'ResetCheck', 'PrintReport'];

        if (in_array($_GET['request'], $commands))
        {
            $mercuryWrapper->OpenSession();

            if ($_GET['request'] == 'GetDriverInfo'){
                $cashboxResponse = $mercuryWrapper->GetDriverInfo();
//                $cashboxResponse['code'] = 200;
//                $cashboxResponse['lastRequest'] = 'DrivverInfo';
//                $cashboxResponse['data'] = [
//                    'result' => 0,
//                    'driverVer' => '1.11.0.643',
//                    'protocolVer' => '3.6',
//                    'driverBaseVer' => '0.4'
//                ];
            }

            if ($_GET['request'] == 'CreateCheck'){
                $goods = [
                    0 => [
                        'productName' => 'Ветеринарные услуги',
                        'qty' => '10000',
                        'price' => '100',
                        'type' => 4
                    ]];
                $cashboxResponse = $mercuryWrapper->CreateCheck($goods);
            }

            if ($_GET['request'] == 'ResetCheck'){
                $cashboxResponse = $mercuryWrapper->ResetCheck();
            }

            if ($_GET['request'] == 'PrintReport'){
                $cashboxResponse = $mercuryWrapper->PrintReport();
            }
        }


        return $this->render('cashboxpage', compact('clinic', 'mercuryWrapper', 'cashboxResponse'));
    }
}