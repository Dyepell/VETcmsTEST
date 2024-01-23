<?php
namespace MercuryAPI;

use yii\httpclient\Client;
/*
 *
 *
 *
 * После тестов поменять области видимости
 *
 *
 *
 * */

class MercuryWrapper
{
    public $sessionKey = '';
    private $client;
    private $url = 'http://localhost:50010/api.json';
    private $lastRequest = '';
    private $lastResponseCode = '';
    private $defaultRequestData = [
        "portName" => "COM5", //имя коммуникационного порта ПК, к которому подключена ККТ
        "baudRate" => 115200, //скорость обмена с ККТ в бодах (бит/с)
        "model" => "185F", //модель ККТ с которой устанавливается связь
        "debug" => true, //признак необходимости ведения отладочного лога драйвером
        "logPath" =>  "d:\\openserver\\openserver\\openserver\\MercuryLog", //полный путь к каталогу, в котором драйвер будет сохранять логфайлы
        "sessionKey" => null
    ];
    private $defaultHeaders = [
        'Accept' => 'application/json, text/javascript, */*; q=0.01',
        'ContentType' => 'application/json; charset=utf-8'
    ];
    private $cashierInfo = [
        "cashierName" => "Зайцева Н.В.",
        "cashierINN" => "123456789012"
    ];
    private $address = "617760, Пермский край, г. Чайковский, ул. Кабалевского, 24а";
    private $location = "\"Зоодоктор\"";
    private $email = "zoodoktor88@mail.ru";
    private $debugGoods = [
        0 => [
            'productName' => 'Ветеринарные услуги',
            'qty' => '1000',
            'price' => '10'
        ]
    ];

    //http://localhost:50010/api.json
    public function __construct(string $baseUrl, string $address, string $logation, string $email,
                                string $casierName, string $cashierInn){
        $this->client = new Client(['baseUrl' => $baseUrl]);
        $this->setUserInfo($address, $logation, $email, $casierName, $cashierInn);
    }


    private function setUserInfo(string $address, string $logation, string $email, string $casierName, string $cashierInn) {
        $this->address = $address;
        $this->location = $logation;
        $this->email = $email;
        $this->cashierInfo['cashierName'] = $casierName;
        $this->cashierInfo['cashierINN'] = $cashierInn;
    }


    function __destruct() {
        if ($this->sessionKey != '')
        {
            $this->CloseSession();
        }
    }


    private function CreateRequest(string $method, array $data): array {
        $result['code'] = 228;
        $result['lastRequest'] = $this->lastRequest;
        $result['data'] = null;

        $response = $this->client->createRequest()->setMethod($method)
            ->setHeaders($this->defaultHeaders)
            ->setFormat(Client::FORMAT_JSON)
            ->setUrl($this->url)
            ->setData(array_merge($this->defaultRequestData, $data))
            ->send();

        if ($response->getData() == NULL)
        {
            $result['code'] = '400';
            $result['data'] = "$this->lastRequest request failed ";
            return $result;
        }

        $result['code'] = $response->statusCode;
        $this->lastResponseCode = $response->statusCode;

        //сделать иключения
        if ($response->isOk) {
            $result['data'] = $response->getData();
        }

        return $result;
    }


    public function GetDriverInfo() {
        $this->lastRequest = __FUNCTION__;

        $result = $this->CreateRequest('POST', ["command" => "GetDriverInfo"]);
        return $result;
    }


    public function OpenSession() {
        $this->lastRequest = __FUNCTION__;
        $result['code'] = 228;
        $result['data'] = '';

        $temp = json_decode(file_get_contents(__DIR__ . '/../../widgets/MercuryWrapper/SessionKey.json'), true);

        if (is_null($temp['startSessionTime']) OR ((time() - $temp['startSessionTime']) > 0)) {
            $temp['startSessionTime'] = time();
            $result = $this->CreateRequest('POST', ["command" => "OpenSession"]);
            $this->sessionKey = $result['data']['sessionKey'];
            $temp['sessionKey'] = $this->sessionKey;
            //пихнуть SessionKey в куки
            file_put_contents(__DIR__ . '/../../widgets/MercuryWrapper/SessionKey.json', json_encode($temp));
        } else
            $this->sessionKey = $temp['sessionKey'];

        return $result;
    }


    public function CloseSession(){
        $this->lastRequest = __FUNCTION__;
        $result = $this->CreateRequest('POST', ["sessionKey" => "$this->sessionKey", "command" => "CloseSession",]);

        return $result;
    }


    public function OpenCheck() {
        $this->lastRequest = __FUNCTION__;
        $result = $this->CreateRequest(
            'POST',
            [
                "sessionKey" => $this->sessionKey,
                "command" => "OpenCheck",
                "checkType" => 0,
                "taxSystem" => 5,
                "address" => $this->address,
                "location" => $this->location,
                "senderEmail" => $this->email,
                "printDoc" =>  true,
                "cashierInfo" => $this->cashierInfo
            ]
        );

        return $result;
    }


    public function AddGoods(string $productName, int $qty = 10000, float $price, int $productTypeCode = 4, string $extraGoodInfo = '', int $measureUnit = 0, int $taxCode = 5, int $paymentFormCode = 4) {
        $this->lastRequest = __FUNCTION__;
        $result = $this->CreateRequest(
            'POST',
            [
                "sessionKey" => $this->sessionKey,
                "command" => "AddGoods",
                "productName" => $productName,
                "qty" => $qty,  // 1 шт = 10000
                "measureUnit" => $measureUnit,  // меры количества товара, таблица 11. 0 - шт
                "taxCode" => $taxCode,  //код налоговой ставки, таблица 4. 5 - Ставка НДС 0%
                "paymentFormCode" => $paymentFormCode, //код способа расчёта, таблица 5. 4 - Полная оплата
                "productTypeCode" => $productTypeCode, //код признака предмета расчёта, таблица 1. 4 - Услуга, 1 - товар
                "price" => $price,  // 100 = 1 руб
                "addInfo" => $extraGoodInfo
            ]
        );

        return $result;
    }


    public function CloseCheck(string $buyerEmail = '', float $cash = 0, float $ecash = 0, float $prepayment = 0, float $credit = 0, string $extraCheckInfo = '') {
        $this->lastRequest = __FUNCTION__;
        $result = $this->CreateRequest(
            'POST',
            [
                "sessionKey" => $this->sessionKey,
                "command" => "CloseCheck",
                "sendCheckTo" => $buyerEmail,
                "addInfo" => $extraCheckInfo,
                "payment" => [
                    "cash" => $cash,
                    "ecash" => $ecash,
                    "prepayment" => $prepayment, //сумма предоплатой
                    "credit" => $credit,  //сумма постоплатой
                    "consideration" => 0 //сумма встречным предоставлением
                ]
            ]
        );

        return $result;
    }


    public function CreateCheck(array $goods = [
            0 => [
                'productName' => 'Ветеринарные услуги',
                'qty' => '10000',
                'price' => '100',
                'type' => 4
            ]], int $payType = 1, string $buyerEmail = '') {
        $sum = 0;
        $cash = 0;
        $ecash = 0;
        $result['code'] = 228;
        $result['data'] = [];

        $openCheckResult = $this->OpenCheck();

        if ($openCheckResult['code'] != 200)
            return $openCheckResult;

        foreach ($goods as $good) {
            //добавить остальные параметры и сделать пересчет qty
            $this->AddGoods($good['productName'],  $good['qty'], $good['price'], $good['type']);
            $sum = $sum +  ($good['qty'] * $good['price']);
        }

        if ($payType == 1) {

            $cash = $sum;
        }
        elseif ($payType == 2) {
            $ecash = $sum;
        }
        else {
            //исключение
            $cash = $sum;
        }

        $result = $this->CloseCheck($buyerEmail, $cash, $ecash);
        $result['data']['mySum'] = $sum;
        return $result;
    }


    public function ResetCheck() {
        $this->lastRequest = __FUNCTION__;
        $result = $this->CreateRequest(
            'POST',
            [
                "sessionKey" => $this->sessionKey,
                "command" => "ResetCheck",
            ]
        );

        return $result;
    }


    public function OpenShift(): array {
        $this->lastRequest = __FUNCTION__;
        $result = $this->CreateRequest(
            'POST',
            [
                "sessionKey" => $this->sessionKey,
                "command" => "OpenShift",
                "printDoc" => true,
                "cashierInfo" => $this->cashierInfo
            ]
        );

        return $result;
    }


    public function CloseShift():array {
        $this->lastRequest = __FUNCTION__;
        $result = $this->CreateRequest(
            'POST',
            [
                "sessionKey" => $this->sessionKey,
                "command" => "CloseShift",
                "printDoc" => true,
                "cashierInfo" => $this->cashierInfo
            ]
        );

        return $result;
    }


    public function GetGoodsBase() {
        $this->lastRequest = __FUNCTION__;
        $result = $this->CreateRequest(
            'POST',
            [
                "sessionKey" => $this->sessionKey,
                "command" => "GetGoodsBase",
            ]
        );

        return $result;
    }


    public function PrintReport(int $reportCode = 5) {
        $this->lastRequest = __FUNCTION__;
        $result = $this->CreateRequest(
            'POST',
            [
                "sessionKey" => $this->sessionKey,
                "command" => "PrintReport",
                "reportCode" => $reportCode
            ]
        );

        return $result;
    }


    //регистрация ккт

}