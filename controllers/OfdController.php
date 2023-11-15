<?php
    namespace app\controllers;

    use app\models\Client;
    use app\models\Doctor;
    use app\models\Istbol;
    use app\models\Pacient;
    use app\models\Sl_vakc;
    use app\models\Vizit;
    use yii\base\BaseObject;
    use yii\httpclient;
    use yii\data\ActiveDataProvider;
    use app\models\DoctorForm;
    use MercuryAPI\MercuryAPI;
    use SbisAPI\SbisAPI;
    use Yii;



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
        $mercuryApi = new MercuryAPI('http://localhost:50010/api.json');
    }
    public function actionMercurytest()
    {
        $mercuryApi = new MercuryAPI('http://localhost:50010/api.json');

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
        $mercuryApi->OpenSession();
        $this->dump($mercuryApi->sessionKey);
        if ($_GET['mode'] == '050771') {

            return $this->render('debug', compact('goods'));
        }

        return 1;
    }

    public function actionMercurydebug()
    {
        $result['code'] = '228';
        $result['data'] = $_GET['request'];

        $mercuryApi = new MercuryAPI('http://localhost:50010/api.json');

        if (method_exists($mercuryApi, $_GET['request'])) {
            $temp = $_GET['request'];
            $result = $mercuryApi->$temp();
            return json_encode($result, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        }
        return json_encode($result, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }
}