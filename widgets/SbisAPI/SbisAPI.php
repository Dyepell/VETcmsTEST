<?php
namespace SbisAPI;

use yii\base\BaseObject;
use yii\httpclient\Client;

class SbisAPI
{
    public $authData;
    private $client;
    private $inn = '592006771808';


    public function __construct(){
        $this->client = new Client(['baseUrl' => 'https://api.sbis.ru/']);
    }


    function dump($arr){
        echo '<pre>'.print_r($arr, true).'</pre>';
    }


    public function Authorization() {
        $result = [];
        $result['code'] = 200;

        $this->authData = json_decode(file_get_contents(__DIR__ . '/../../widgets/SbisAPI/authData.json'), true);
        $result = $this->authData;

        if ((time() - $this->authData['authTime']) > 86400) {
            $response = $this->client->createRequest()
                ->setMethod('POST')
                ->setFormat(Client::FORMAT_JSON)
                ->setUrl('https://api.sbis.ru/oauth/service/')
                ->setData([
                    "app_client_id" => "***",
                    "login" => "***",
                    "password" => "***"
                ])
                ->send();

            $result['code'] = $response->statusCode;

            if ($response->isOk)
            {
                $this->authData = $response->getData();
                $this->authData['authTime'] = time();
                file_put_contents(__DIR__ . '/../../widgets/SbisAPI/authData.json', json_encode($this->authData));
                $result['data'] = $this->authData;
            }
        }

        return $result;
    }


    public function GetKKTList() {
        $result = [];
        $result['code'] = 200;

        $response = $this->client->createRequest()
            ->setMethod('GET')
            ->setUrl("https://api.sbis.ru/ofd/v1/orgs/$this->inn/kkts?status=2")
            ->addHeaders(['Cookie' => "sid=".$this->authData['sid']])
            ->send();

        $result['code'] = $response->statusCode;

        if ($response->isOk)
            $result['data'] = $response->getData()[0];

        return $result;
    }


    public function RegisterCheck() {
        $result = [];
        $result['code'] = 200;

        $response = $this->client->createRequest()
            ->setMethod('GET')
            ->setUrl("https://api.sbis.ru/ofd/v1/orgs/$this->inn/kkts?status=2")
            ->addHeaders(['Cookie' => "sid=".$this->authData['sid']])
            ->send();

        $result['code'] = $response->statusCode;

        if ($response->isOk)
            $result['data'] = $response->getData()[0];

        return $result;
    }

}