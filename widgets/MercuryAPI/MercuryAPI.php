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

class MercuryAPI
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


    public function __construct(){
        $this->client = new Client(['baseUrl' => 'http://localhost:50010/api.json']);
    }


    function __destruct() {
        if ($this->sessionKey != '')
        {
            $this->CloseSession();
        }
    }


    function dump($arr){
        echo '<pre>'.print_r($arr, true).'</pre>';
    }


    private function CreateRequest(string $method, array $data): array {
        $result = [];

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
            $result['data'] = $response->getData()[0];
        }

        return $result;
    }


    public function GetDriverInfo() {
        $this->lastRequest = __FUNCTION__;
        $result = $this->CreateRequest('POST', ["command" => "GetDriverInfo"]);
        return $result;
    }


    public function OpenSession(): string {
//        $response = $this->client->createRequest()
//            ->setMethod('POST')
//            ->addHeaders([
//                'Accept' => 'application/json, text/javascript, */*; q=0.01',
//                'ContentType' => 'application/json; charset=utf-8'
//            ])
//            ->setFormat(Client::FORMAT_JSON)
//            ->setUrl('http://localhost:50010/api.json')
//            ->setData([
//                "sessionKey" => null,
//                "command" => "OpenSession",
//                "portName" => "COM5",
//                "baudRate" => 115200,
//                "model" => "185F",
//                "debug" => true,
//                "logPath"=>  "d:\\openserver\\openserver\\openserver\\MercuryLog"
//            ])
//            ->send();
//
//        if ($response->getData() == NULL)
//        {
//            echo 'OpenSession Request failed';
//            return $result;
//        }
        $this->lastRequest = __FUNCTION__;
        $result = $this->CreateRequest('POST', ["command" => "OpenSession"]);
        $this->dump($result);
        $this->sessionKey = $result['data']['sessionKey'];

        return $this->sessionKey;
    }


    public function CloseSession(): bool{
//
//        $response = $this->client->createRequest()
//            ->setMethod('POST')
//            ->addHeaders([
//                'Accept' => 'application/json, text/javascript, */*; q=0.01',
//                'ContentType' => 'application/json; charset=utf-8'
//            ])
//            ->setFormat(Client::FORMAT_JSON)
//            ->setUrl('http://localhost:50010/api.json')
//            ->setData([
//                "sessionKey" => $this->sessionKey,
//                "command" => "CloseSession",
//            ])
//            ->send();
//
//        if ($response->getData() == NULL)
//        {
//            echo 'CloseSession Request failed';
//            return $result;
//        }
//
//        $result['code'] = $response->statusCode;
//
//        if ($response->isOk)
//            $result['data'] = $response->getData()[0];
//        else
//            echo 'Bad request';
        $this->lastRequest = __FUNCTION__;
        $result = $this->CreateRequest('POST', ["sessionKey" => $this->sessionKey, "command" => "CloseSession",]);

        return true;
    }


    public function OpenCheck(): bool {
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

        return true;
    }


    public function AddGoods(string $productName, int $qty = 10000, float $price, string $extraGoodInfo = '', int $measureUnit = 0, int $taxCode = 5, int $paymentFormCode = 4, int $productTypeCode = 4): bool {
        $this->lastRequest = __FUNCTION__;
        $result = $this->CreateRequest(
            'POST',
            [
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

        return true;
    }


    private function CloseCheck(string $buyerEmail, float $cash, float $ecash, float $prepayment = 0, float $credit = 0, string $extraCheckInfo = ''): bool {
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

        return true;
    }


    public function CreateCheck(array $goods, int $payType, string $buyerEmail):float {
        $sum = 0;
        $cash = 0;
        $ecash = 0;
        $this->OpenCheck();

        foreach ($goods as $good) {
            //добавить остальные параметры и сделать пересчет qty
            $this->AddGoods($good['productName'],  $good['qty'], $good['price']);
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

        $this->CloseCheck($buyerEmail, $cash, $ecash);

        return $sum;
    }


    //reset check


    //открытие смены
    public function OpenShift() {

    }

    //закрытие смены
    public function CloseShift() {

    }


    //регистрация ккт

}