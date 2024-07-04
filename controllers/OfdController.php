<?php
    namespace app\controllers;

    use app\models\ClinicForm;
    use app\models\User;

    use MercuryAPI\MercuryWrapper;
    use SbisAPI\SbisAPI;



class OfdController extends AppController
{
    public $layout='basic';

    function dump($arr){
        echo '<pre>'.print_r($arr, true).'</pre>';
    }

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

    public function actionSbistest()
    {
        $sbisApi = new SbisAPI();
        $sbisApi->Authorization();
        $kktList = $sbisApi->GetKKTList();
        $this->dump($kktList);
        return true;
    }
    public function actionPrintCheck(){
        $mercuryApi = new MercuryWrapper('http://localhost:50010/api.json');
    }
    public function actionMercurytest()
    {
        $clinic = ClinicForm::findOne(['id'=>1]);

        $mercuryWrapper = new MercuryWrapper('http://localhost:50010/api.json',
            $clinic->address, $clinic->clinicName, $clinic->email, $clinic->entrepreneurName, $clinic->entrepreneurINN);

        $goods = [
            'productName' => 'Ветеринарные услуги',
            'qty' => '10000',
            'price' => '100'
        ];
//        $response = $mercuryApi->OpenSession();
//
//        $this->dump($mercuryApi->sessionKey);
//        $mercuryApi->GetDriverInfo();

//        if ($_GET['command'] == 'createCheck') {
//            $test = $mercuryApi->CreateCheck();
//            echo 'Sum:';
//            $this->dump($test);
//        }
        $mercuryWrapper->OpenSession();
        $this->dump($mercuryWrapper->sessionKey);

        if ($_GET['mode'] == '050771') {
            return $this->render('debug', compact('goods'));
        }

        return 1;
    }

    public function actionMercurydebug()
    {
        $result['code'] = '228';
        $result['data'] = $_GET['request'];
        $clinic = ClinicForm::findOne(['id'=>1]);

        $mercuryWrapper = new MercuryWrapper('http://localhost:50010/api.json',
            $clinic->address, $clinic->clinicName, $clinic->email, $clinic->entrepreneurName, $clinic->entrepreneurINN);

        if (method_exists($mercuryWrapper, $_GET['request'])) {
            $temp = $_GET['request'];
            $result = $mercuryWrapper->$temp();
            return json_encode($result, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        }
        return json_encode($result, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }
}